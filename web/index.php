<?php

require_once __DIR__.'/../vendor/autoload.php';

$baseServices = require_once __DIR__.'/../config/framework.config.php';


$pathForThemes = __DIR__.'/vendors/';
$themeForUI    = $pathForThemes."happy-scroll";

$container = DevMediaLab\ContainerFactory::createContainer();
$builder = new DevMediaLab\ContainerBuilder($container);
$container = $builder->build();

$framework = new DevMediaLab\Framework($container['event.dispatcher'], $container['controller.resolver'], $container);

use Symfony\Component\HttpKernel\HttpCache\HttpCache;
use Symfony\Component\HttpKernel\HttpCache\Store;

$framework = new HttpCache($framework, new Store(__DIR__.'/../app/cache/'));
$framework->handle($container['http.request'])->send();
$framework->terminate($container['http.request'], $container['http.response']);