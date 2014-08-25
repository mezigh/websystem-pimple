<?php
namespace DevMediaLab;


use Pimple\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class WebSystem extends Container implements HttpKernelInterface
{
	const VERSION = "0.1.0-dev";
	const NAME    = "WebSystem";


    public function __construct()
	{
		parent::__construct();
	}

	public function handle()
	{

		$context = $this->getContainer()->get('request_context');
		$context->fromRequest($request);
		$matcher = $this->getContainer()->get('url_matcher');
		$resolver = $this->getContainer()->get('controller_resolver');

		try {
			$attributes = $matcher->match($request->getPathInfo());
			$request->attributes->add($attributes);
			$controller = $resolver->getController($request);
			$arguments = $resolver->getArguments($request, $controller);

			$response = call_user_func_array($controller, $arguments);

		} catch (Routing\Exception\ResourceNotFoundException $e) {
		    $response = new Response("not found",404);
		} catch (Exception $e) {
		    $response = new Response('An error occurred', 500);
		}

		$response->send();
	}

    /**
     * return the instance of the container
     * @return ContainerBuilder           The container
     */
    public function getContainer()
    {
        return $this->container;
    }

}
