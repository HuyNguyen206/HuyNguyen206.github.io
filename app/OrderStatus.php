<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    //
    function order()
    {
        return $this->hasMany(Order::class, 'order_status');
    }
}
