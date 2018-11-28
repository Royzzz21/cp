<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        ////// 로그인 되어있을때 어떻게 처리할지 결정한다.
//        echo "RedirectIfAuthenticated";exit;
//        echo $guard;exit;
        if (Auth::guard($guard)->check()) {
//            echo "RedirectIfAuthenticated: logged";exit;

            return redirect('/');
        }

        return $next($request);
    }
}
