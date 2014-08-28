<?php
namespace DevMediaLab;

use Pimple\Container;

class ContainerFactory
{
    public static function createContainer()
    {
        return new Container();
    }

    public function buildContainer()
    {

    }

    public function addReference($reference)
    {

    }

    public function addReferenceForFactory($reference)
    {

    }
} 