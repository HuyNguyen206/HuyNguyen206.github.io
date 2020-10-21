<?php

namespace App;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductTag extends Model
{
    use SoftDeletes;
    //
    protected $guarded = [];
    protected $table = 'product_tags';
}
