<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    //
    function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    function customers()
    {
        return $this->hasMany(Customer::class, 'district_id');
    }
}
