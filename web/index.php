<?php

require_once __DIR__.'/../vendor/autoload.php';

$pathForThemes = __DIR__.'/vendors/';
$themeForUI    = $pathForThemes."happy-scroll";

use DevMediaLab\Listeners\StageControllerListener;
use DevMediaLab\Providers\TwigServiceProvider;
use DevMediaLab\BaseView;
use DevMediaLab\Facade;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\HttpCache\HttpCache;
use Symfony\Component\HttpKernel\HttpCache\Store;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\EventListener\ExceptionListener;

$container = new DevMediaLab\ContainerFactory;

$container = $container::createContainer();

$container['http.request'] = function($c) {
    return Request::createFromGlobals();
};

$container['request.context'] = function($c) {
    return new RequestContext();
};

$request = $container['http.request'];

$container['stage.controller'] = function($c) {
  return new StageController($c);
};

$routes = include __DIR__.'/../app/routes.php';

$container['url.matcher'] = function($c) use($routes) {
    return new UrlMatcher($routes, $c['request.context']);
};

$container['controller.resolver'] = function($c) {
    return new ControllerResolver();
};

$container['event.dispatcher'] = function($c) {
    return new EventDispatcher();
};

$container['router.listener'] = function($c) {
    return new RouterListener($c['url.matcher']);
};

$container['http.response'] = function($c) {
    return new Response;
};

$response = $container['http.response'];

$container['exception.listener'] = function($c) {
    return new ExceptionListener("DevMediaLab\\ErrorInterceptor::exceptionAction");
};

$container['stage.controller.listener'] = function($c) {
    return new StageControllerListener();
};

/* Listeners */
$container['event.dispatcher']->addSubscriber($container['router.listener']);
$container['event.dispatcher']->addSubscriber($container['exception.listener']);
// $container['event.dispatcher']->addSubscriber($container['stage.controller.listener']);

/* Twig */
$container->register(new TwigServiceProvider());

$container['twig'] = $container->extend('twig', function ($twig, $container) {
    return $twig;
});

$container['base.view'] = function($c) {
    return new BaseView($c['twig']);
};

/* Facades
Facade::clearResolvedInstances();
Facade::setFacadeApplication($app);
*/

$framework = new DevMediaLab\Framework($container['event.dispatcher'], $container['controller.resolver'], $container);

$framework = new HttpCache($framework, new Store(__DIR__.'/../app/cache/'));

$framework->handle($request)->send();

$framework->terminate($request, $response);