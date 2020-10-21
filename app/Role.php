<?php

namespace App;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    //
    use SoftDeletes;
    function users()
    {
        return $this->belongsToMany(User::class, 'user_roles', 'role_id', 'user_id')->withTimestamps();;
    }
    function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_roles', 'role_id', 'permission_id')->withTimestamps();
    }
}
