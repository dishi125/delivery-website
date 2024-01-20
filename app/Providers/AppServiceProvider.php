<?php

namespace App\Providers;

use Illuminate\Support\Facades\Request;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
          if (env('APP_ENV') != 'local')
           {
                    $url->forceScheme('https');
           }
        Schema::defaultStringLength(5000);

//        if(config('app.env') === 'production') {
//            URL::forceScheme('https');
//        }
    }
}



