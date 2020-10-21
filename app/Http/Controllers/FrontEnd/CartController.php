<?php

namespace App\Http\Controllers\FrontEnd;

use App\CouponCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Order;
use App\OrderDetail;
use App\PaymentLog;
use App\PaymentMethod;
use App\Product;
use App\TransportCompany;
use App\User;
use App\VpnPaymentStatus;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    //

    function addToCart(Request $request, $id, $quantity = 1)
    {
        try {
//            Session::flush();
//            Session::save();
//            dd();
            Session::forget('couponCode');
            $cart =  Session::get('cart');
            $product = Product::find($id);
            if(isset($cart[$id]))
            {
                $cart[$id]['quantity'] = $cart[$id]['quantity'] + $quantity;
            }
            else
            {
                $cart[$id] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'feature_image_path' => $product->feature_image_path
                ];
            }
            Session::put('cart', $cart);
            Session::save();
            return response()->json(['code' => 200, 'message' => 'success'], 200);
        }
        catch(\Exception $ex)
        {
            return response()->json(['code' => 500, 'message' => $ex->getMessage()], 500);
        }
    }

    function showCart()
    {
//        Session::forget('cart');
//        Session::save();
//        dd();
        $codeValue = Session::get('couponCode');
        if(isset($codeValue))
        {
            $couponCode = CouponCode::where('code', Session::get('couponCode'))->first();
        }
        else
        {
            $couponCode = null;
        }
        $cart = empty(Session::get('cart')) ? [] : Session::get('cart');
//        dd($cart);
        return view('frontend.cart.show-cart', compact('cart', 'couponCode'));
    }

    function updateCart(Request $request)
    {
        try
        {
            Session::forget('couponCode');
            if(Session::has('cart'))
            {
                $cart = Session::get('cart');
                $cart[$request->id]['quantity']= $request->quantity;
                Session::put('cart', $cart);
            }
            else
            {
                $cart = [];
            }
            Session::save();
            $cart_update_view = view('frontend.cart.components.cart-component', compact('cart'))->render();
            return response()->json(['code' => 200, 'message' => 'success', 'cart_update_view' => $cart_update_view], 200);
        }
        catch (\Exception $ex)
        {
            return response()->json(['code' => 200, 'message' => $ex->getMessage()], 500);
        }
    }

    function removeCartProduct($id)
    {
        try
        {
            Session::forget('couponCode');
            if(Session::has('cart'))
            {
                $cart = Session::get('cart');
                unset($cart[$id]);
                Session::put('cart', $cart);
            }
            else
            {
                $cart = [];
            }
            Session::save();
            $cart_update_view = view('frontend.cart.components.cart-component', compact('cart'))->render();
            return response()->json(['code' => 200, 'message' => 'success', 'cart_update_view' => $cart_update_view], 200);
        }
        catch (\Exception $ex)
        {
            return response()->json(['code' => 200, 'message' => $ex->getMessage()], 500);
        }
    }
    function checkout()
    {
        if(\Auth::check())
        {
            $codeValue = Session::get('couponCode');
            if(isset($codeValue))
            {
                $couponCode = CouponCode::where('code', Session::get('couponCode'))->first();
            }
            else
            {
                $couponCode = null;
            }
            $user = User::find(\Auth::id());
            $cart = empty(Session::get('cart')) ? [] : Session::get('cart');
            $paymentMethods = PaymentMethod::all();
            $transportCompanies = TransportCompany::all();
            return view('frontend.checkout.show-checkout', compact('user', 'cart','paymentMethods', 'transportCompanies', 'couponCode'));
        }
        return redirect('login');
    }

    function order(OrderRequest $request)
    {
        try {

            \DB::beginTransaction();
            $cart = Session::get('cart');
            if(empty($cart))
            {
                return redirect('/');
            }
            $cartCollect = collect($cart);
//            dd($cartCollect);
            $order = new Order();
            $order->payment_method = $request->payment_method;
            $order->customer_id = \Auth::user()->customer->id;
//            $order->order_total =  $cartCollect->sum('price');
            $order->order_status = $request->payment_method == 1 ? 1 : 6;
            $order->order_note = $request->order_note;
            $order->transport_company = $request->transport_company;
            $order->save();
            $orderTotal = 0;
            foreach($cartCollect as $id => $product)
            {
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $id;
                $orderDetail->product_price=  $product['price'];
                $orderDetail->product_sale_quantity = $product['quantity'];
                $orderDetail->save();
                $orderTotal += $product['price'] * $product['quantity'];
            }
            //Update total price for order
            $order->order_total = $orderTotal;
            $couponCodeSession = Session::pull('couponCode');
            if($couponCodeSession)
            {
                $couponCode = CouponCode::where('code',$couponCodeSession)->first();
                $couponCode->quantity_used = $couponCode->quantity_used + 1;
                $couponCode->save();
                $order->coupon_code_id = $couponCode->id;
            }
            $order->save();
            //Remove all product in cart
            $cart = [];
            Session::put('cart', $cart);
            Session::save();
            \DB::commit();
            //VNPay
            if($request->payment_method == 1)
            {
                $paymentLog = new PaymentLog();
                $paymentLog->input = json_encode(['userId' => \Auth::id(), 'Orderid' => $order->id, 'TotalPayment' => $orderTotal]);
                $paymentLog->save();
                Session::put('paymentLogId', $paymentLog->id);
               return redirect($this->createMerchant($request, $order->id, $orderTotal));
            }
            return view('frontend.checkout.checkout-result', ['isSuccess' => true, 'message' => 'Bạn đã đặt hàng thành công. Chúng tôi sẽ liên hệ lại với bạn sớm nhất!']);
        }
        catch(\Exception $ex)
        {
            \DB::rollback();
            return view('frontend.checkout.checkout-result', ['isSuccess' => false, 'message' => 'Có lỗi xảy ra trong quá trình đặt hàng: '.  $ex->getMessage()]);
        }

    }

    private function createMerchant($request, $orderId, $totalAmount)
    {
//    session(['cost_id' => $request->id]);
//    session(['url_prev' => url()->previous()]);
        $vnp_TmnCode = "8I0DSOVT"; //Mã website tại VNPAY
        $vnp_HashSecret = config('vnpay.vnp_HashSecret');
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "https://laravel-hitech-shopping.com/return-vnpay";
        $vnp_TxnRef = $orderId; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = $request->order_note;
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $totalAmount * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $request->ip();

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        return $vnp_Url;
    }

    function checkCoupon(Request $request)
    {
        try
        {
            $couponCode = CouponCode::where('code', $request->couponCode)->first();
            if(empty($couponCode))
            {
                return response()->json(['code' => 500, 'message' => 'Mã code không tồn tại'], 200);
            }
            if($couponCode->quantity_used == $couponCode->quantity)
            {
                return response()->json(['code' => 500, 'message' => 'Code đã sử dụng hết'], 200);
            }
            if($couponCode->start_date > Carbon::now() || Carbon::now()  > $couponCode->end_date)
            {
                return response()->json(['code' => 500, 'message' => 'Code nằm ngoài thời gian sử dụng'], 200);
            }
            Session::put('couponCode', $couponCode->code);
            Session::save();
            $cart =  Session::get('cart');
            $cart_update_view = view('frontend.cart.components.cart-component', compact('cart', 'couponCode'))->render();
            return response()->json(['code' => 200, 'message' => 'success', 'cart_update_view' => $cart_update_view], 200);
        }
        catch (\Exception $ex)
        {
            return response()->json(['code' => 500, 'message' => $ex->getMessage()], 200);
        }
    }

    function removeCoupon(Request $request)
    {
        Session::pull('couponCode');
        Session::save();
        $cart =  Session::get('cart', []);
        $cart_update_view = view('frontend.cart.components.cart-component', compact('cart'))->render();
        return response()->json(['code' => 200, 'message' => 'success', 'cart_update_view' => $cart_update_view], 200);
    }

    function handleReturnData(Request $request)
    {

        $isTransactionSuccess = false;
        $inputData = array();
        $returnData = array();
        $vnp_HashSecret = config('vnpay.vnp_HashSecret');
        $data = $request->all();
        foreach ($data as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHashType']);
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . $key . "=" . $value;
            } else {
                $hashData = $hashData . $key . "=" . $value;
                $i = 1;
            }
        }
        $vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
        $vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
//$secureHash = md5($vnp_HashSecret . $hashData);
        $secureHash = hash('sha256',$vnp_HashSecret . $hashData);
        $Status = 0;

        try {
            DB::beginTransaction();
            //Check Orderid
            //Kiểm tra checksum của dữ liệu
            if ($secureHash == $vnp_SecureHash) {
                //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái của đơn hàng, mã đơn hàng là: $orderId
                //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
                //Giả sử: $order = mysqli_fetch_assoc($result);
                $orderId = $inputData['vnp_TxnRef'];
                $order = Order::find($orderId);
                if (isset($order)) {
                        $vpnStatus = new VpnPaymentStatus();
                        if ($inputData['vnp_ResponseCode'] == '00') {
                            $description = 'Giao dich thanh cong';
                            $order->order_status = 6;
                            $responseMessage = "Bạn đã đặt hàng thành công. Chúng tôi sẽ liên hệ lại với bạn sớm nhất!";
                            $isTransactionSuccess = true;
                        } else {
                            $order->order_status = 5;
                           switch ($inputData['vnp_ResponseCode'])
                           {
                               case '01':
                                   $description = 'Giao dich da ton tai';
                                   break;
                               case '02':
                                   $description = 'Merchant ko hop le';
                                   break;
                               case '03':
                                   $description = 'Du lieu gui sang khong dung';
                                   break;
                               case '04':
                                   $description = 'Khoi tai giao dich ko thanh cong';
                                   break;
                               case '08':
                                   $description = 'He thong ngan hang dang bao tri';
                                   break;
                               default:
                                   $description = 'Co loi xay ra';
                           }
                            $responseMessage = $description;
                        }
                        $code = $inputData['vnp_ResponseCode'];
                    $order->save();
                    $vpnStatus->order_id = $orderId;
                    $vpnStatus->code = $code;
                    $vpnStatus->description = $description;
                    $vpnStatus->save();
                    $paymentOutPut = 'Dữ liệu trả về từ VNPayment hợp lệ';

                } else {
                    $responseMessage = "Có lỗi phát sinh trong quá trình xử lý giao dịch!";
                    $paymentOutPut = 'Don hang khong ton tai';
                }
            } else {
                $responseMessage = "Có lỗi phát sinh trong quá trình xử lý giao dịch!";
                $paymentOutPut = "Chu ky khong hop le";
            }
            $paymentLogId = Session::get('paymentLogId');
            $paymentLog = PaymentLog::find($paymentLogId);
            $paymentLog->output = $paymentOutPut;
            $paymentLog->save();
            DB::commit();
            return view('frontend.checkout.checkout-result', ['isSuccess' => $isTransactionSuccess, 'message' => $responseMessage]);

        } catch (Exception $e) {
            DB::rollBack();
            $isTransactionSuccess= false;
            $paymentLogId = Session::get('paymentLogId');
            $paymentLog = PaymentLog::find($paymentLogId);
            $paymentLog->output = $e->getMessage();
            $paymentLog->save();
            return view('frontend.checkout.checkout-result', ['isSuccess' => $isTransactionSuccess, 'message' => $e->getMessage()]);
        }
    }


}
