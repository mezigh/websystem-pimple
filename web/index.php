<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpKernel\HttpCache\HttpCache;
use Symfony\Component\HttpKernel\HttpCache\Store;

$baseServices = require_once __DIR__.'/../config/framework.config.php';

$container = DevMediaLab\ContainerFactory::createContainer();

$builder = new DevMediaLab\ContainerBuilder($container);

/*$yml = $container['yaml'];
$config_yml = __DIR__.'/../config/websystem.yml';
$conf_from_yml = $yml::parse(file_get_contents($config_yml));

var_dump($conf_from_yml);

exit;*/

$container = $builder->build();

$framework = new DevMediaLab\Framework($container['event.dispatcher'], $container['controller.resolver'], $container);

$framework = new HttpCache($framework, new Store(__DIR__.'/../app/cache/'));

$framework->handle($container['http.request'])->send();

$framework->terminate($container['http.request'], $container['http.response']);