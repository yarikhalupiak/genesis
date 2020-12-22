<?php

declare(strict_types=1);

namespace App\Core\Interfaces;

interface ResponseInterface
{
    public function setOutput($output): void;

    public function send(): void;
}