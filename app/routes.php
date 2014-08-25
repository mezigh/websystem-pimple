<?php
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('home', new Route('/', [
    'content' => "WebSystem with Symfony 2 components",
    '_controller' => [ $container['stage.controller'],'indexAction'],
]));

$routes->add('services', new Route('/services', [
    'content' => "WebSystem Services",
    '_controller' => [ $container['stage.controller'],'servicesAction'],
]));

$routes->add('portfolio', new Route('/portfolio', [
    'content' => "WebSystem PORTFOLIO",
    '_controller' => [ $container['stage.controller'],'portfolioAction'],
]));

$routes->add('pricing', new Route('/pricing', [
    'content' => "WebSystem Price",
    '_controller' => [ $container['stage.controller'],'pricingAction'],
]));

$routes->add('about', new Route('/about', [
    'content' => "WebSystem is born with Yolo Framework in mind",
    '_controller' => [ $container['stage.controller'],'aboutAction'],
]));

$routes->add('blog', new Route('/blog',[
    'content' => "WebSystem Blog",
    '_controller' => [ $container['stage.controller'],'blogAction'],
]));

$routes->add('news', new Route('/news', [
    'content' => "WebSystem Actualités",
    '_controller' => [ $container['stage.controller'],'newsAction'],
]));

$routes->add('contact', new Route('/contact', [
    'content' => "WebSystem Contact Us",
    '_controller' => [ $container['stage.controller'],'contactAction'],
]));

return $routes;
