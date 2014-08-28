<?php
namespace DevMediaLab;

use Pimple\Container;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\HttpKernel\HttpKernel;


class Framework extends HttpKernel
{
    protected $dispatcher;
    protected $resolver;
    protected $container;

    /**
     * @param EventDispatcherInterface $dispatcher
     * @param ControllerResolverInterface $resolver
     * @param Container $container
     */
    public function __construct(EventDispatcherInterface $dispatcher, ControllerResolverInterface $resolver, Container $container)
    {
        parent::__construct($dispatcher, $resolver);
        $this->container = $container;
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }





}