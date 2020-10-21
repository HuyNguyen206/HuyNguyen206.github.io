<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    function getListOrder()
    {
        $orders = Order::latest()->get();
        return view('backend.pages.order.list', compact('orders'));
    }

    function getOrderDetail($id)
    {
        $order = Order::find($id);
        return view('backend.pages.order.order-detail', compact('order'));
    }
}
