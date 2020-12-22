<?php

declare(strict_types=1);

namespace App\Service;

use App\Dto\MessageDto;

interface MessagePusherInterface
{
    public const MESSAGE_LIST_KEY = 'messages';

    public function push(MessageDto $dto): void;
}
