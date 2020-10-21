<?php

namespace App\Http\Middleware;

use Closure;

class ForbidCustomerAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $rolesOfUser = \Auth::user()->roles;
//        dd($rolesOfUser);
        if($rolesOfUser->contains('id', 4) && $rolesOfUser->count() == 1)
        {

            return response()->view('errors.frontend.prevent-access-to-backend');
        }
        return $next($request);
    }
}
