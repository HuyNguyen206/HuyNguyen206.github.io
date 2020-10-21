<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
//        Gate::define('list-category-check', function($user){
//
//           return  $user->checkPermission(config('permission.access.list-category'));
//        });
//        Gate::define('list-menu-check', function($user){
//            return  $user->checkPermission(config('permission.access.list-menu'));
//        });
//        Gate::define('list-setting-check', function($user){
//            return  $user->checkPermission('setting');
//        });


        //
    }
}
