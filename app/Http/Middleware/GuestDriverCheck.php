<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class GuestDriverCheck
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
        if (Session::get('Driverid')[0]==null) {
            return $next($request);
        }
        else{
            return redirect('/home_driver');
        }
    }
}
