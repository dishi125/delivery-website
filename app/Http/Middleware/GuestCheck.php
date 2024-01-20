<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class GuestCheck
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
        if ( (Session::get('Userid')[0] ?? null)==null && (Session::get('Driverid')[0]??null)==null) {
            return $next($request);
        }
        else if( (Session::get('Userid')[0]?? null)!=null){
            return redirect('/home_user');
        }
        else{
            return redirect('/home_driver');
        }

    }
}
