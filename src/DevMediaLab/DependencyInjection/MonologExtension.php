<?php

namespace DevMediaLab\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class MonologExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $container
            ->register('logger', 'Monolog\Logger')
            ->setArguments(['%app.name%']);
    }
}
