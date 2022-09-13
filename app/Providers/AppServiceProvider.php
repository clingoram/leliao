<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// add
// use Illuminate\Support\Facades\URL;

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
    // public function boot()
    // {
    // }

    public function boot()
    {
        // if ($this->app->environment('production')) {
        //     URL::forceScheme('https');
        // }
        // if (env('APP_ENV') === 'production') {
        //     URL::forceScheme('https');
        // }
    }
}
