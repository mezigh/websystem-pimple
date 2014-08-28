<?php
namespace DevMediaLab\Facades;

use DevMediaLab\Facade;

class Framework extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'framework';
    }
} 