<?php
namespace DevMediaLab\Listeners;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Response;

class StageControllerListener implements EventSubscriberInterface
{

    public function onRequest(GetResponseEvent $event)
    {
        $event->getRequest()->attributes->set('title',"DevMediaLab Web");
    }

    public function onController(FilterControllerEvent $event)
    {
        $event->getRequest()->attributes->set('title', $event->getRequest()->attributes->get('title')."BiSh" );
    }

    public function onFilterResponse(FilterResponseEvent $event)
    {
        $event->getResponse()->setTtl(60);
    }

    public function onView(GetResponseForControllerResultEvent $event)
    {
        $response = new Response();

        $controllerResult = $event->getControllerResult();

        if ($controllerResult instanceof Response )
        {
            $controllerResult->setContent($controllerResult." RESPONSE by EventDispatcher with Subscriber Class\n");
            $event->setResponse($controllerResult);

        } elseif (is_string($controllerResult)) {

            $response->setContent($controllerResult);
            $response->setContent($response->getContent()." STRINGS by EventDispatcher with Subscriber Class\n");
            $event->setResponse($response);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.request'    => 'onRequest',
            'kernel.controller' => 'onController',
            'kernel.view'       => 'onView',
            'kernel.response'   => 'onFilterResponse'
        ];
    }
}
