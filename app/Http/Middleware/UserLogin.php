<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class UserLogin
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

        if ((Session::get('Userid')[0] ?? null) ==null && (Session::get('Driverid')[0] ?? null) ==null) {
            return redirect('/signin');
        }
        return $next($request);
    }
}
