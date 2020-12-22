<?php

declare(strict_types=1);

namespace App\Core\Interfaces;

interface ContainerInterface
{
    public function get(string $id);

    public function has(string $id);
}
