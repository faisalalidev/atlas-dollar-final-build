<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {

            if(in_array('auth:' . config('constants.WEB_GUARD_NAME') , $request->route()->middleware())) {
                return route(config('constants.WEB_PREFIX') . 'login');
            }

            if(in_array('auth:' . config('constants.ADMIN_GUARD_NAME') , $request->route()->middleware())) {
                return route(config('constants.ADMIN_PREFIX') . 'login');
            }

        }
    }
}
