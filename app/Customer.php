<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    //
    use SoftDeletes;

    function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}
