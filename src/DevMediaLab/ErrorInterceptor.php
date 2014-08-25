<?php
namespace DevMediaLab;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Debug\Exception\FlattenException;

class ErrorInterceptor
{

    public function exceptionAction(FlattenException $exception)
    {
        $msg = "Every thing is broken very badly [DEBUG : ".$exception->getStatusCode()."]".$exception->getMessage()."\n";
        $response = new Response();
        return $response->setContent($msg, $exception->getStatusCode());
    }

    public function __toString()
    {
        return "ErrorInterceptor";
    }

} 