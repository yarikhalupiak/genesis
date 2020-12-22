<?php

declare(strict_types=1);

namespace App\Core\Interfaces;

interface RequestInterface
{
    public function getUri(): string;

    public function getMethod(): string;

    public function getQueryParam(string $key): ?string;
}