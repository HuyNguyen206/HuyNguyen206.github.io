<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransportCompany extends Model
{
    //
    function orders()
    {
        return $this->hasMany(Order::class, 'transport_company');
    }
}
