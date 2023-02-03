<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
    public function boot()
    {
        ini_set('mbstring.internal_encoding' , 'UTF-8');
        Schema::defaultStringLength(191);
        if (\App::environment('production')) {
            \URL::forceScheme('https');
            \DB::select("SET time_zone = '+09:00'");
        }
        
    }
}
