<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Weather extends Facade {

    protected static function getFacadeAccessor() : string
    {
        return 'weather';
    }   

}