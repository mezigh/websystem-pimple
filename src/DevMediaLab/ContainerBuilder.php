<?php
namespace DevMediaLab;

use StageController;
use DevMediaLab\Providers\MonologServiceProvider;
use DevMediaLab\Listeners\StageControllerListener;
use DevMediaLab\Providers\TwigServiceProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\EventListener\ExceptionListener;
use Symfony\Component\Yaml\Yaml;
use Pimple\Container;

class ContainerBuilder
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->container['yaml'] = function($c) {
            return new Yaml();
        };
    }

    public function build()
    {
        $this->container['http.request'] = function($c) {
            return Request::createFromGlobals();
        };

        $this->container['request.context'] = function($c) {
            return new RequestContext();
        };

        $this->container['stage.controller'] = function($c) {
            return new StageController($c);
        };

        $this->container['routes'] = require_once __DIR__.'/../../app/routes.php';

        $this->container['url.matcher'] = function($c) {
            return new UrlMatcher($c['routes'], $c['request.context']);
        };

        $this->container['controller.resolver'] = function($c) {
            return new ControllerResolver();
        };

        $this->container['event.dispatcher'] = function($c) {
            return new EventDispatcher();
        };

        $this->container->register(new MonologServiceProvider());

        $this->container['router.listener'] = function($c) {
            return new RouterListener($c['url.matcher'], $c['request.context'] ,$c['logger']);
        };

        $this->container['http.response'] = function($c) {
            return new Response;
        };

        $this->container['exception.listener'] = function($c) {
            return new ExceptionListener("DevMediaLab\\ErrorInterceptor::exceptionAction");
        };

        $this->container['stage.controller.listener'] = function($c) {
            return new StageControllerListener();
        };

        /* Listeners */
        $this->container['event.dispatcher']->addSubscriber($this->container['router.listener']);
        $this->container['event.dispatcher']->addSubscriber($this->container['exception.listener']);
        // $this->container['event.dispatcher']->addSubscriber($container['stage.controller.listener']);

        /* Twig */
        $this->container->register(new TwigServiceProvider());

        $this->container['twig'] = $this->container->extend('twig', function ($twig, $container) {
            return $twig;
        });

        return $this->container;

    }
} 