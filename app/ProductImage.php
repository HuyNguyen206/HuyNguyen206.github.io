<?php

namespace App;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
    use SoftDeletes;
    //
    protected $table = 'product_images';
    protected $guarded = [];

    function product()
    {
        return $this->belongsTo('App\Products', 'product_id');
    }
}
