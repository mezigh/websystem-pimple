<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
        $response = new Response($this->getTwig()->render('/pages/index.html.twig', ['active'=>$request->attributes->get('_route'), 'class'=>'homepage', 'title'=>"WebSystem | Twig" , 'content' => $request->get('content')]) );
        // $response->setTtl(19);

        return $response;
    }

    public function servicesAction(Request $request)
    {
        /* bs-multipurpose-ruma */
        extract($request->attributes->all(), EXTR_SKIP);
        $response = new Response($this->getTwig()->render('/pages/services.html.twig', ['active'=>$request->attributes->get('_route'), 'class'=>'', 'title'=>"WebSystem | Services" , 'content' => $request->get('content')]) );
        // $response->setTtl(19);

        return $response;
    }

    public function portfolioAction(Request $request)
    {
        /* bs-multipurpose-ruma */
        extract($request->attributes->all(), EXTR_SKIP);
        $response = new Response($this->getTwig()->render('/pages/portfolio.html.twig', ['active'=>$request->attributes->get('_route'), 'class'=>'', 'title'=>"WebSystem | Services" , 'content' => $request->get('content')]) );
        // $response->setTtl(19);

        return $response;
    }

    public function pricingAction(Request $request)
    {
        /* bs-multipurpose-ruma */
        extract($request->attributes->all(), EXTR_SKIP);
        $response = new Response($this->getTwig()->render('/pages/pricing.html.twig', ['active'=>$request->attributes->get('_route'), 'class'=>'', 'title'=>"WebSystem | Services" , 'content' => $request->get('content')]) );
        // $response->setTtl(19);

        return $response;
    }

    public function postContactAction(Request $request)
    {
        /* TODO implement swiftmailer */
        var_dump($request->get('email'));
        exit;
    }

    public function loginAction(Request $request)
    {
        extract($request->attributes->all(), EXTR_SKIP);
        $response = new Response($this->getTwig()->render('/pages/login.html.twig', ['active'=>$request->attributes->get('_route'), 'class'=>'', 'title'=>"WebSystem | Login" , 'content' => $request->get('content')]) );
        // $response->setTtl(19);

        return $response;
    }

    public function postLoginAction(Request $request)
    {
        $email = $request->get('email');
        $pass  = $request->get('password');


        return new RedirectResponse('/services');
    }


    public function aboutAction(Request $request)
    {
        extract($request->attributes->all(), EXTR_SKIP);
        $response = new Response($this->getTwig()->render('/pages/about-us.html.twig', ['active'=>$request->attributes->get('_route'), 'class'=>'', 'title'=>"WebSystem | About" , 'content' => $request->get('content')]) );
        // $response->setTtl(19);

        return $response;
    }

    public function shortcodesAction(Request $request)
    {
        extract($request->attributes->all(), EXTR_SKIP);
        $response = new Response($this->getTwig()->render('/pages/shortcodes.html.twig', ['active'=>$request->attributes->get('_route'), 'class'=>'', 'title'=>"WebSystem | About" , 'content' => $request->get('content')]) );
        // $response->setTtl(19);

        return $response;
    }

    public function blogAction(Request $request)
    {
        extract($request->attributes->all(), EXTR_SKIP);
        $response = new Response($this->getTwig()->render('/pages/blog.html.twig', ['active'=>$request->attributes->get('_route'), 'class'=>'', 'title'=>"WebSystem | About" , 'content' => $request->get('content')]) );
        // $response->setTtl(19);

        return $response;
    }

    public function blogItemAction(Request $request)
    {
        extract($request->attributes->all(), EXTR_SKIP);
        $response = new Response($this->getTwig()->render('/pages/blog-item.html.twig', ['active'=>$request->attributes->get('_route'), 'class'=>'', 'title'=>"WebSystem | Blog-Single" , 'content' => $request->get('content')]) );
        // $response->setTtl(19);

        return $response;
    }

    public function newsAction(Request $request)
    {
        return $this->renderTemplate($request);
    }

    public function contactAction(Request $request)
    {
        /* bs-multipurpose-ruma */
        extract($request->attributes->all(), EXTR_SKIP);
        $response = new Response($this->getTwig()->render('/pages/contact-us.html.twig', ['active'=>$request->attributes->get('_route'), 'class'=>'', 'title'=>"WebSystem | Contact" , 'content' => $request->get('content')]) );
        // $response->setTtl(19);

        return $response;
    }

    protected function prepareResponse()
    {

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
