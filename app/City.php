<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    function districts()
    {
        return $this->hasMany(District::class, 'city_id');
    }
    function customers()
    {
        return $this->hasMany(Customer::class, 'city_id');
    }
}
