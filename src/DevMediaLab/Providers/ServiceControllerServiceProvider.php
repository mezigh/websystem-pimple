<?php

/*
 * This file is part of the Silex framework.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DevMediaLab\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use DevMediaLab\ServiceControllerResolver;

class ServiceControllerServiceProvider implements ServiceProviderInterface
{
    public function register(Container $container)
    {
        $container->extend('controller.resolver', function ( $resolver,$container) {
            return new ServiceControllerResolver($resolver, $container['callback_resolver']);
        });
    }
}
