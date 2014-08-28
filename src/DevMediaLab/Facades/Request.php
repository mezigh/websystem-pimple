<?php
namespace DevMediaLab\Facades;

use DevMediaLab\Facade;

class Request extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'http.request';
    }
} 