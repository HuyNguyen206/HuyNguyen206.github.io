<?php

namespace App\Http\Controllers;

use App\CouponCode;
use App\CouponType;
use App\Http\Requests\CreateCouponRequest;
use App\Http\Requests\CreateSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Setting;
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Mockery\Exception;

class CouponController extends Controller
{
    //
    use DeleteModelTrait;
    function getListCoupon()
    {
        $coupons = CouponCode::latest()->get();
        return view('backend.pages.coupon.list', compact('coupons'));
    }

    function getFormCoupon()
    {
        $couponTypes = CouponType::all();
        return view('backend.pages.coupon.add', compact('couponTypes'));
    }

    function postFormCoupon(CreateCouponRequest $request)
    {
        try {
            $coupon= new CouponCode();
            $coupon->name = $request->name;
            $coupon->code = $request->code;
            $coupon->coupon_type = $request->coupon_type;
            $coupon->quantity = $request->quantity;
            $coupon->description = $request->description;
            $coupon->start_date = $request->start_date;
            $coupon->end_date = $request->end_date;
            $coupon->code_value = $request->code_value;
            $coupon->save();
            return redirect()->back()->with('message', 'Tạo Coupon thành công')->with('isSuccess', true);
        } catch (Exception $ex) {
            Log::error($ex->getMessage() . ' at line ', $ex->getLine());
            return redirect()->back()->with('message', $ex->getMessage())->with('isSuccess', false);;
        }

    }

    function getEditCoupon($id)
    {
        $coupon = CouponCode::find($id);
        $couponTypes = CouponType::all();
        return view('backend/pages/coupon/edit', compact('coupon', 'couponTypes'));

    }

    function postEditCoupon(CreateCouponRequest $request, $id)
    {
        try {
            $coupon = CouponCode::find($id);
            $coupon->name = $request->name;
            $coupon->code = $request->code;
            $coupon->coupon_type = $request->coupon_type;
            $coupon->quantity = $request->quantity;
            $coupon->description = $request->description;
            $coupon->start_date = $request->start_date;
            $coupon->end_date = $request->end_date;
            $coupon->code_value = $request->code_value;
            $coupon->save();
            return redirect()->back()->with('message', 'Chỉnh sửa coupon thành công')->with('isSuccess', true);
        } catch (Exception $ex) {
            Log::error($ex->getMessage() . ' at line ', $ex->getLine());
            return redirect()->back()->with('message', $ex->getMessage())->with('isSuccess', false);;
        }
    }

    function deleteCoupon($id)
    {
        return $this->delete(new CouponCode(), $id, false,"");

    }
}
