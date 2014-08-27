<?php
return [
    "components" => [
        'http.request',
        'request.context',
        'stage.controller',
        'url.matcher',
        'controller.resolver',
        'event.dispatcher',
        'router.listener',
        'http.response',
        'exception.listener',
        'stage.controller.listener',
        'twig',
        'base.view'
    ]
];



$routes = include __DIR__.'/../app/routes.php';

$container->register(new TwigServiceProvider());

