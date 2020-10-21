<?php

namespace App;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    //
    use SoftDeletes;
    protected $guarded = [];
    function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_roles', 'permission_id', 'role_id')->withTimestamps();;
    }

    function childPermission()
    {
        return $this->hasMany(Permission::class, 'parent_id');
    }
    function parentPermisison()
    {
        return $this->belongsTo(Permission::class, 'parent_id');
    }
}
