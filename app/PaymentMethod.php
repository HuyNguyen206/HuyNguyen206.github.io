<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    //
    function orders()
    {
        return $this->hasMany(Order::class, 'payment_method');
    }
}
