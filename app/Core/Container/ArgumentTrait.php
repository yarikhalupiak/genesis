<?php

declare(strict_types=1);

namespace App\Core\Container;

trait ArgumentTrait
{
    public function resolveArguments(array $arguments): array
    {
        foreach ($arguments as &$arg) {
            if (! is_string($arg)) {
                continue;
            }

            $container = $this->getContainer();

            if ($container !== null && $container->has($arg)) {
                $arg = $container->get($arg);

                continue;
            }
        }

        return $arguments;
    }
}
