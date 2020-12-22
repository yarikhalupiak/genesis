<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Interfaces\RequestInterface;

final class Request implements RequestInterface
{
    public $get = [];

    public function __construct()
    {
        $this->get = $_GET;
    }

    public function getUri(): string
    {
        return strtok($_SERVER['REQUEST_URI'], '?');
    }

    public function getMethod(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD']) ?? 'GET';
    }

    public function getQueryParam(string $param): ?string
    {
        if (array_key_exists($param, $this->get)) {
            return $this->get[$param];
        }

        return null;
    }
}
