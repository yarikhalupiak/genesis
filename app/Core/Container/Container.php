<?php

declare(strict_types=1);

namespace App\Core\Container;

use App\Core\Interfaces\ContainerInterface;
use Generator;
use InvalidArgumentException;

class Container implements ContainerInterface
{
    use ContainerTrait;

    protected $definitions = [];

    public function __construct()
    {
        $this->setContainer($this);
    }

    public function add(string $id, $definition = null): Definition
    {
        if (! $definition instanceof Definition) {
            $definition = (new Definition($id, $definition));
        }

        $this->definitions[] = $definition->setAlias($id);

        return $definition;
    }

    public function get(string $id, bool $new = false): object
    {
        if ($this->has($id)) {
            return ($this->getDefinition($id))->resolve($new);
        }

        throw new InvalidArgumentException("Alias is undefined by: $id");
    }

    public function has(string $id): bool
    {
        foreach ($this->getIterator() as $definition) {
            if ($id === $definition->getAlias()) {
                return true;
            }
        }

        return false;
    }

    public function getIterator(): Generator
    {
        $count = count($this->definitions);

        for ($i = 0; $i < $count; $i++) {
            yield $this->definitions[$i];
        }
    }

    public function getDefinition(string $id): Definition
    {
        /* @var Definition $definition */
        foreach ($this->getIterator() as $definition) {
            if ($id === $definition->getAlias()) {
                return $definition->setContainer($this->getContainer());
            }
        }

        throw new InvalidArgumentException("Definition is undefined by: $id");
    }
}