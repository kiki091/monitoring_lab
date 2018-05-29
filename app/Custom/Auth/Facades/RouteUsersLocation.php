<?php

namespace App\Custom\Auth\Facades;

use Illuminate\Support\Facades\Facade;

class RouteUsersLocation extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'RouteUsersLocation';
    }
}