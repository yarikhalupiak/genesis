<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Interfaces\ContainerInterface;
use App\Core\Interfaces\RedisInterface;
use App\Core\Interfaces\ResponseInterface;
use App\Service\MessageWorker;

final class ConsoleKernel
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function handle(): ResponseInterface
    {
        (new MessageWorker($this->container->get(RedisInterface::class)))->run();
    }
}
