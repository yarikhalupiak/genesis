<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Interfaces\RouterInterface;
use LogicException;
use RuntimeException;

final class Router implements RouterInterface
{
    private $request;

    private $routes = [];

    public function __construct(array $routes, Request $request)
    {
        $this->set($routes);
        $this->request = $request;
    }

    public function getAction(): string
    {
        $uri = $this->request->getUri();

        if (! $this->has($uri)) {
            throw new RuntimeException("Route is undefined by uri: $uri");
        }

        [$method, $action] = $this->routes[$uri];

        if ($method !== $this->request->getMethod()) {
            throw new RuntimeException("Invalid request method: $method");
        }

        return $action;
    }

    public function add(string $uri, array $definition): void
    {
        [$method, $action] = $definition;

        if (! is_string($method) || ! class_exists($action)) {
            throw new LogicException('Invalid route definition');
        }

        $this->routes[$uri] = $definition;
    }

    public function set(array $routes)
    {
        foreach ($routes as $uri => $definition) {
            $this->add($uri, $definition);
        }
    }

    public function has(string $uri): bool
    {
        return isset($this->routes[$uri]);
    }
}
