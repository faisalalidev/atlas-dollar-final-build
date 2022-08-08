<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                if ($guard === config('constants.ADMIN_GUARD_NAME')) {

                    return redirect(route(config('constants.ADMIN_PREFIX') . 'dashboard'));

                }

                return redirect(route(config('constants.WEB_PREFIX') . 'home'));
            }
        }

        return $next($request);
    }
}
