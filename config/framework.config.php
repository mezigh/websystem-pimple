<?php

return [
    "components" => [
        'http.request',
        'request.context',
        'stage.controller',
        'url.matcher',
        'controller.resolver',
        'event.dispatcher',
        'router.listener',
        'http.response',
        'exception.listener',
        'stage.controller.listener',
        'twig'
    ],

    "aliases" => [
        'Framework' => 'DevMediaLab\Framework',
        'Request'   => 'Symfony\Component\HttpFoundation\Request',
        'Response'  => 'Symfony\Component\HttpFoundation\Response'
    ]

];
