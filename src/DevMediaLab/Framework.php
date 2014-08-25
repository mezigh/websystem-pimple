<?php
namespace DevMediaLab;

use Pimple\Container;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\HttpKernel\HttpKernel;
use DevMediaLab\ContainerFactory;


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

    public function configureContainer()
    {

    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    public function makeAlias($aliases)
    {
        foreach ($aliases as $original => $alias) {
            class_alias($original, $alias);
        }
    }

    /**
     * Alias a type to a shorter name.
     *
     * @param string $abstract
     * @param string $alias
     * @return void
     */
    public function alias($abstract, $alias)
    {
        $this->aliases[$alias] = $abstract;
    }
    /**
     * Extract the type and alias from a given definition.
     *
     * @param array $definition
     * @return array
     */
    protected function extractAlias(array $definition)
    {
        return array(key($definition), current($definition));
    }






}