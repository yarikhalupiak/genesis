<?php

declare(strict_types=1);

namespace App\Service;

use App\Core\Interfaces\RedisInterface;
use App\Dto\MessageDto;

final class MessagePusher implements MessagePusherInterface
{
    private $redis;

    public function __construct(RedisInterface $redis)
    {
        $this->redis = $redis;
    }

    public function push(MessageDto $dto): void
    {
        $this->redis->zAdd(
            MessagePusherInterface::MESSAGE_LIST_KEY,
            $dto->getTimestamp(),
            $dto->getMessage()
        );
    }
}
