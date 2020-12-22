<?php

declare(strict_types=1);

namespace App\Factory\Controller;

use App\Core\Interfaces\ContainerInterface;
use App\Core\Interfaces\ResponseInterface;
use App\Http\Controller\MessageController;
use App\Service\MessagePusherInterface;

class MessageControllerFactory
{
    public function __invoke(ContainerInterface $container): MessageController
    {
        return new MessageController(
            $container->get(ResponseInterface::class),
            $container->get(MessagePusherInterface::class)
        );
    }
}