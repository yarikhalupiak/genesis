<?php

declare(strict_types=1);

namespace App\Core\Interfaces;

interface RouterInterface
{
    public function getAction(): string;
}
