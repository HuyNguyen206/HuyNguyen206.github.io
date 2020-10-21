<?php

namespace App;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //
    use SoftDeletes;
    protected $table = 'categories';
    public $timestamps = true;
    protected $guarded = [];

    function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    function childCategory()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }


    function productChildCategory()
    {
        return $this->hasManyThrough(Product::class, Category::class, 'parent_id', 'category_id');
    }
}
