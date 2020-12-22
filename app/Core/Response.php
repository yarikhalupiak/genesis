<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Interfaces\ResponseInterface;

final class Response implements ResponseInterface
{
    private $output;

    public function setOutput($output): void
    {
        $this->output = $output;
    }

    public function send(): void
    {
        if ($this->output) {
            echo $this->output;
        }
    }
}
