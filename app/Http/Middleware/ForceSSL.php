<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
class ForceSSL
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
        if (!$request->secure() && App::environment() === 'local') {

            $uri = 'http://localhost/delivery-website/signin';
            return redirect()->secure($uri);
        }

        return $next($request);


    }
}
