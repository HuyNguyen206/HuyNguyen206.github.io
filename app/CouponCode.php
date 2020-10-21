<?php

namespace App;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CouponCode extends Model
{
    //
    use SoftDeletes;
    protected $table = 'coupon_code';
    function couponType()
    {
        return $this->belongsTo(CouponType::class, 'coupon_type');
    }

    function orders()
    {
        return $this->hasMany(Order::class, 'coupon_code_id');
    }
}
