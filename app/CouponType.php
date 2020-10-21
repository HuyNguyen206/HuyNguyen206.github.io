<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponType extends Model
{
    //
    protected $table = 'coupon_type';
    function couponCode()
    {
        return $this->hasMany(CouponCode::class, 'coupon_type');
    }
}
