<?php

namespace App;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomVerifyEmail;
use NotificationChannels\WebPush\HasPushSubscriptions;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use Notifiable;
    use SoftDeletes;
    use CanResetPassword;
    use HasPushSubscriptions;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function products()
    {
        return $this->hasMany('App\Product', 'user_id');
    }

    function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id')->withTimestamps();;
    }
    function checkPermission($permissionKeyCode)
    {
        $roles = \Auth::getUser()->roles;
//        dump($roles, $permissionKeyCode);
        foreach($roles as $role)
        {
            $permissionUser = $role->permissions;
//            dd($permissionUser);
            if($permissionUser->contains('key_code', $permissionKeyCode))
            return true;
        }
        return false;
    }

    function customer()
    {
        return $this->hasOne(Customer::class, 'user_id');
    }

    function socialAccounts()
    {
        return $this->hasMany(LinkedSocialAccount::class, 'user_id');
    }
    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail); // my notification
    }


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
