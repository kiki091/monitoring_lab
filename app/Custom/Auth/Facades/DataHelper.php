<?php

namespace App\Custom\Auth\Facades;

use Illuminate\Support\Facades\Facade;

class DataHelper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'DataHelper';
    }
}