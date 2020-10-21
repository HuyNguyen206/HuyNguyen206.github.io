<?php

namespace App;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    //
    use SoftDeletes;
    public $timestamps = true;
    protected $guarded = [];
}
