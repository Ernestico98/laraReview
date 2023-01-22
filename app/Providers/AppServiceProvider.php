<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Weather;

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
        $this->app->singleton('weather', fn() => new Weather());   
    }
}
