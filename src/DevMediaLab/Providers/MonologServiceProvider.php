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
use Monolog\Formatter\LineFormatter;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use DevMediaLab\Api\BootableProviderInterface;
use Symfony\Bridge\Monolog\Handler\DebugHandler;
use DevMediaLab\EventListener\LogListener;

/**
 * Monolog Provider.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class MonologServiceProvider implements ServiceProviderInterface, BootableProviderInterface
{
    public function register(Container $app)
    {
        $app['logger'] = function () use ($app) {
            return $app['monolog'];
        };

        $app['monolog.logfile'] = __DIR__.'/../../../app/logs/development.log';

        if ($bridge = class_exists('Symfony\Bridge\Monolog\Logger')) {
            $app['monolog.handler.debug'] = function () use ($app) {
                $level = MonologServiceProvider::translateLevel($app['monolog.level']);

                return new DebugHandler($level);
            };
        }

        $app['monolog.logger.class'] = $bridge ? 'Symfony\Bridge\Monolog\Logger' : 'Monolog\Logger';

        $app['monolog'] = function ($app) {
            $log = new $app['monolog.logger.class']($app['monolog.name']);

            $log->pushHandler($app['monolog.handler']);

            if (isset($app['debug']) && $app['debug'] && isset($app['monolog.handler.debug'])) {
                $log->pushHandler($app['monolog.handler.debug']);
            }

            return $log;
        };

        $app['monolog.formatter'] = function () {
            return new LineFormatter();
        };

        $app['monolog.handler'] = function () use ($app) {
            $level = MonologServiceProvider::translateLevel($app['monolog.level']);

            $handler = new StreamHandler($app['monolog.logfile'], $level, $app['monolog.bubble'], $app['monolog.permission']);
            $handler->setFormatter($app['monolog.formatter']);

            return $handler;
        };

        $app['monolog.level'] = function () {
            return Logger::DEBUG;
        };

        $app['monolog.listener'] = function () use ($app) {
            return new LogListener($app['logger'], $app['monolog.exception.logger_filter']);
        };

        $app['monolog.name'] = 'WebSystem';
        $app['monolog.bubble'] = true;
        $app['monolog.permission'] = null;
        $app['monolog.exception.logger_filter'] = null;

        $this->boot($app);
    }

    public function boot(Container $app)
    {
        if (isset($app['monolog.listener'])) {
            $app['event.dispatcher']->addSubscriber($app['monolog.listener']);
        }
    }

    public static function translateLevel($name)
    {
        // level is already translated to logger constant, return as-is
        if (is_int($name)) {
            return $name;
        }

        $levels = Logger::getLevels();
        $upper = strtoupper($name);

        if (!isset($levels[$upper])) {
            throw new \InvalidArgumentException("Provided logging level '$name' does not exist. Must be a valid monolog logging level.");
        }

        return $levels[$upper];
    }
}
