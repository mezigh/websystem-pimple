<?php
namespace DevMediaLab\Facades;

use DevMediaLab\Facade;

class Container extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'container';
    }
} 