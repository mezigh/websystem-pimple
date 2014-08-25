<?php
namespace DevMediaLab\Events;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\Event;

class ResponseEvent extends Event
{
    private $response;
    private $request;

    public function __construct(Response $response, Request $request)
    {
        $this->response = $response;
        $this->request  = $request;
    }

    /**
     * Get the value of Response
     *
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Get the value of Request
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

}
