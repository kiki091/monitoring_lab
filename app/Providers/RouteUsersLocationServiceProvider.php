<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Custom\Auth\RouteUsersLocation;

class RouteUsersLocationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('RouteUsersLocation', function () {
            return new RouteUsersLocation;
        });
    }
}
