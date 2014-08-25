<?php
namespace DevMediaLab\Listeners;

use DevMediaLab\Events\ResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class GoogleListener implements EventSubscriberInterface
{
    public function onResponse(ResponseEvent $event)
    {
        $response = $event->getResponse();
        $response->setContent($response->getContent()."Google Analytics by EventDispatcher with Subscriber Class\n");
    }

    public static function getSubscribedEvents()
    {
        return ['response' => 'onResponse'];
    }
}
