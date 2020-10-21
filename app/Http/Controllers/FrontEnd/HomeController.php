<?php

namespace App\Http\Controllers\FrontEnd;

use App\Category;
use App\Contact;
use App\CouponCode;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\StoreContactRequest;
use App\Order;
use App\OrderDetail;
use App\PaymentMethod;
use App\Product;
use App\Slider;
use App\Traits\CreateMetaSEOTrait;
use App\TransportCompany;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    //
    use CreateMetaSEOTrait;
    public function __construct()
    {
//        $this->middleware(['verified']);
    }

    function index()
    {
        $products= Product::latest()->take(6)->get();
        $sliders = Slider::latest()->take(4)->get();
        $recommendProducts= Product::latest('views_count')->get();
        $metaSEOTag = $this->createMetaTag('ShoppingHiTech - Website chuyên bán các thiết bị, linh kiện điện tử',
            'Hệ thống bán lẻ điện thoại di động, smartphone, máy tính bảng, tablet, laptop, phụ kiện, smartwatch, đồng hồ chính hãng mới nhất, giá tốt, dịch vụ khách hàng được yêu thích nhất VN',
            'điện thoại di động, dtdd, smartphone, tablet');
        return view('frontend.home.main-page', compact('products', 'sliders', 'recommendProducts', 'metaSEOTag'));
    }

    function showContact()
    {
        return view('frontend.contact.contact-form');
    }

    function storeContact(StoreContactRequest $request)
    {
        try {
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->subject = $request->subject;
            $contact->email = $request->email;
            $contact->message = $request->message;
            $contact->save();

            return redirect()->back()->with(['isSuccess' => true,
                'message' => "<h3>Thank you for contacting us.</h3><br>You are very important to us,
                                all information received will always remain confidential.
                                We will contact you as soon as we review your message."]);
        }
        catch(\Exception $ex)
        {
            return redirect()->back()->with(['isSuccess' => false, 'message' => $ex->getMessage()]);
        }

    }
}
