<?php

namespace DevMediaLab\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Extension\Extension;

class ServiceControllerExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $container
            ->register('controller_resolver.service', 'DevMediaLab\ServiceControllerResolver')
            ->setArguments([
                new Reference('controller_resolver'),
                new Reference('service_container'),
            ])
            ->addTag('controller_resolver.decorator', []);
    }
}
