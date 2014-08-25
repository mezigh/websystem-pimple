<?php
namespace DevMediaLab;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

class RouterBuilder
{
	private $routesCollection;

	public function __construct(RouteCollection $routesCollection)
	{
		$this->routesCollection = $routesCollection;
	}

	public function getRoutesCollection()
	{
		return	$this->routesCollection;
	}

	public function get($name, $path, $controller)
	{
		$this->addRoute($name, $path, $controller, 'GET');
	}

	public function post($name, $path, $controller)
	{
		$this->addRoute($name, $path, $controller, 'POST');
	}

	public function put($name, $path, $controller)
	{
		$this->addRoute($name, $path, $controller, 'PUT');
	}

	public function delete($name, $path, $controller)
	{
		$this->addRoute($name, $path, $controller, 'DELETE');
	}

	public function addRoute($name, $path, $controller, $method)
	{
		$this->routesCollection->add($name, new Route($path, ['_controller' => $controller], ['_method' => $method]));
	}

}