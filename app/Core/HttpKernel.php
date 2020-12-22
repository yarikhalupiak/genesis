<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Interfaces\ContainerInterface;
use App\Core\Interfaces\ResponseInterface;
use App\Core\Interfaces\RouterInterface;
use Throwable;

final class HttpKernel
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function handle(): ResponseInterface
    {
        try {
            /** @var RouterInterface $router */
            $router = $this->container->get(RouterInterface::class);

            $handler = $this->container->get($router->getAction());

            return $handler();
        } catch (Throwable $e) {
            $response = $this->container->get(ResponseInterface::class);

            $response->setOutput($e->getMessage());

            return $response;
        }
    }
}
