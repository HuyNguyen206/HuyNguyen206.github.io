<?php

namespace App;

use Eloquent as Model;

class PasswordReset extends Model
{
    //
    protected $table = 'password_resets';
    public $timestamps = false;
    protected $guarded = [];
}
