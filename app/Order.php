<?php

namespace App;

use Eloquent as Model;
class Order extends Model
{
    //
    function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status');
    }

    function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method');
    }

    function transportCompany()
    {
        return $this->belongsTo(TransportCompany::class, 'transport_company');
    }

    function couponCode()
    {
        return $this->belongsTo(CouponCode::class, 'coupon_code_id');
    }

    function VpnPaymentStatus()
    {
        return $this->hasMany(VpnPaymentStatus::class, 'order_id');
    }
}
