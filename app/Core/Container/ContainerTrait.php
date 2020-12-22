<?php

declare(strict_types=1);

namespace App\Core\Container;

use RuntimeException;

trait ContainerTrait
{
    protected $container;

    public function setContainer(Container $container)
    {
        $this->container = $container;

        return $this;
    }

    public function getContainer(): Container
    {
        if ($this->container instanceof Container) {
            return $this->container;
        }

        throw new RuntimeException('No container implementation has been set.');
    }
}