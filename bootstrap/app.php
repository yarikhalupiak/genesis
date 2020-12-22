<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/app.php';

$routes = require_once __DIR__ . '/../route/api.php';

$container = new \App\Core\Container\Container();

$container->add(\App\Core\Interfaces\RequestInterface::class, \App\Core\Request::class);

$container->add(\App\Core\Interfaces\ResponseInterface::class, \App\Core\Response::class);

$container
    ->add(\App\Core\Interfaces\RouterInterface::class, \App\Core\Router::class)
    ->addArgument($routes)
    ->addArgument(\App\Core\Interfaces\RequestInterface::class);

$container->add(\App\Core\Interfaces\RedisInterface::class, \App\Core\Redis::class);

$container
    ->add(\App\Service\MessagePusherInterface::class, \App\Service\MessagePusher::class)
    ->addArgument(\App\Core\Interfaces\RedisInterface::class);

$container
    ->add(\App\Http\Controller\MessageController::class, \App\Http\Controller\MessageController::class)
    ->addArgument(\App\Core\Interfaces\RequestInterface::class)
    ->addArgument(\App\Core\Interfaces\ResponseInterface::class)
    ->addArgument(\App\Service\MessagePusherInterface::class);

$container
    ->add('httpKernel', \App\Core\HttpKernel::class)
    ->addArgument($container);

$container
    ->add('consoleKernel', \App\Core\ConsoleKernel::class)
    ->addArgument($container);

return $container;
