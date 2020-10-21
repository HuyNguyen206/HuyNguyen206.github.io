<?php

namespace App;

use Eloquent as Model;

class Tag extends Model
{
    //
    protected $guarded = [];
    function products()
    {
        return $this->belongsToMany('App\Products', 'product_tags', 'tag_id', 'product_id')->withTimestamps();
    }
}
