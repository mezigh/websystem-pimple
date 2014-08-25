<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Pimple\Container;

class StageController
{
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function indexAction(Request $request)
    {
        extract($request->attributes->all(), EXTR_SKIP);
        $response = new Response($this->getTwig()->render('/pages/index.html.twig', ['title'=>"WebSystem | Twig" , 'content' => $request->get('content')]) );
        // $response->setTtl(19);

        return $response;
    }

    public function servicesAction(Request $request)
    {
        /* bs-multipurpose-ruma */
        extract($request->attributes->all(), EXTR_SKIP);
        $response = new Response($this->getTwig()->render('/pages/services.html.twig', ['title'=>"WebSystem | Services" , 'content' => $request->get('content')]) );
        // $response->setTtl(19);

        return $response;
    }

    public function portfolioAction(Request $request)
    {
        /* bs-multipurpose-ruma */
        extract($request->attributes->all(), EXTR_SKIP);
        $response = new Response($this->getTwig()->render('/pages/portfolio.html.twig', ['title'=>"WebSystem | Services" , 'content' => $request->get('content')]) );
        // $response->setTtl(19);

        return $response;
    }

    public function pricingAction(Request $request)
    {
        /* bs-multipurpose-ruma */
        extract($request->attributes->all(), EXTR_SKIP);
        $response = new Response($this->getTwig()->render('/pages/pricing.html.twig', ['title'=>"WebSystem | Services" , 'content' => $request->get('content')]) );
        // $response->setTtl(19);

        return $response;
    }


    public function aboutAction(Request $request)
    {
        return $this->renderTemplate($request);
    }

    public function blogAction(Request $request)
    {
        return $this->renderTemplate($request);
    }

    public function newsAction(Request $request)
    {
        return $this->renderTemplate($request);
    }

    public function contactAction(Request $request)
    {
        /* bs-multipurpose-ruma */
        extract($request->attributes->all(), EXTR_SKIP);
        $response = new Response($this->getTwig()->render('/pages/contact.html.twig', ['title'=>"WebSystem | Contact" , 'content' => $request->get('content')]) );
        // $response->setTtl(19);

        return $response;
    }

    protected  function getTwig()
    {
        return $this->container['twig'];
    }

    protected function renderTemplate($request)
    {
        extract($request->attributes->all(), EXTR_SKIP);
        ob_start();
        include sprintf(__DIR__.'/pages/%s.php', $_route);

        $response = new Response(ob_get_clean());
        $response->setTtl(19);

        return $response;

    }
}
