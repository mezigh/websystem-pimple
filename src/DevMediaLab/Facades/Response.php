<?php
namespace DevMediaLab\Facades;

use DevMediaLab\Facade;

class Response extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'http.response';
    }
} 