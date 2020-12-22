<?php

declare(strict_types=1);

namespace App\Core\Container;

use ReflectionClass;
use ReflectionException;

class Definition
{
    use ArgumentTrait;
    use ContainerTrait;

    protected $alias;

    protected $concrete;

    protected $resolved;

    protected $arguments = [];

    public function __construct(string $id, $concrete = null)
    {
        $concrete = $concrete ?? $id;

        $this->alias = $id;
        $this->concrete = $concrete;
    }

    public function setAlias(string $id): Definition
    {
        $this->alias = $id;

        return $this;
    }

    public function getAlias(): string
    {
        return $this->alias;
    }

    public function addArgument($arg): Definition
    {
        $this->arguments[] = $arg;

        return $this;
    }

    /**
     * @param bool $new
     * @return mixed|null|object|string
     * @throws ReflectionException
     */
    public function resolve(bool $new = false)
    {
        $concrete = $this->concrete;

        if ($this->resolved !== null && $new === false) {
            return $this->resolved;
        }

        if (is_string($concrete) && class_exists($concrete)) {
            $concrete = $this->resolveClass($concrete);
        }

        $this->resolved = $concrete;

        return $concrete;
    }

    /**
     * @param string $concrete
     * @return object
     * @throws ReflectionException
     */
    protected function resolveClass(string $concrete): object
    {
        $resolved = $this->resolveArguments($this->arguments);
        $reflection = new ReflectionClass($concrete);

        return $reflection->newInstanceArgs($resolved);
    }
}
