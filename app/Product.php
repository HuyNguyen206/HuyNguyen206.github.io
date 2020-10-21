<?php

namespace App;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    //
    function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }
    function productImages()
    {
        return $this->hasMany('App\ProductImage', 'product_id');
    }
    function tags()
    {
        return $this->belongsToMany('App\Tag', 'product_tags', 'product_id', 'tag_id')->withTimestamps();
    }
}
