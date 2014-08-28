<?php
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routes = new RouteCollection();

$routes->add('home', new Route('/', [
    'content' => "WebSystem with Symfony 2 components",
    '_controller' => [ $this->container['stage.controller'],'indexAction'],
    ],['_method' => 'GET']
));

$routes->add('services', new Route('/services', [
    'content' => "WebSystem Services",
    '_controller' => [ $this->container['stage.controller'],'servicesAction'],
],['_method' => 'GET']
));

$routes->add('portfolio', new Route('/portfolio', [
    'content' => "WebSystem PORTFOLIO",
    '_controller' => [ $this->container['stage.controller'],'portfolioAction'],
],['_method' => 'GET']
));

$routes->add('pricing', new Route('/pricing', [
    'content' => "WebSystem Price",
    '_controller' => [ $this->container['stage.controller'],'pricingAction'],
],['_method' => 'GET']
));

$routes->add('about', new Route('/about', [
    'content' => "WebSystem is born with Yolo Framework in mind",
    '_controller' => [ $this->container['stage.controller'],'aboutAction'],
],['_method' => 'GET']
));

$routes->add('blog', new Route('/blog',[
    'content' => "WebSystem Blog",
    '_controller' => [ $this->container['stage.controller'],'blogAction'],
],['_method' => 'GET']
));

$routes->add('login', new Route('/login',[
    'content' => "WebSystem Login",
    '_controller' => [ $this->container['stage.controller'],'loginAction'],
],['_method' => 'GET']
));

$routes->add('post_login', new Route('/post_login', [
    '_controller' => [ $this->container['stage.controller'],'postLoginAction']]
));

$routes->add('blog_item', new Route('/blog-item',[
    'content' => "WebSystem Blog",
    '_controller' => [ $this->container['stage.controller'],'blogItemAction'],
],['_method' => 'GET']
));

$routes->add('news', new Route('/news', [
    'content' => "WebSystem Actualités",
    '_controller' => [ $this->container['stage.controller'],'newsAction'],
],['_method' => 'GET']
));

$routes->add('shortcodes', new Route('/shortcodes', [
        'content' => "WebSystem Actualités",
        '_controller' => [ $this->container['stage.controller'],'shortcodesAction'],
    ],['_method' => 'GET']
));

$routes->add('contact', new Route('/contact', [
    'content' => "WebSystem Contact Us",
    '_controller' => [ $this->container['stage.controller'],'contactAction'],
],['_method' => 'GET']
));

$routes->add('post_contact', new Route('/post_contact', [
    '_controller' => [ $this->container['stage.controller'],'postContactAction']]
));

return $routes;
