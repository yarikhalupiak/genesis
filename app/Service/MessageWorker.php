<?php

declare(strict_types=1);

namespace App\Service;

use App\Core\Interfaces\RedisInterface;

final class MessageWorker
{
    /** @var RedisInterface */
    private $redis;

    public function __construct(RedisInterface $redis)
    {
        $this->redis = $redis;
    }

    public function run(): void
    {
        while (true) {
            $data = $this->redis->zRangeByScore(
                MessagePusherInterface::MESSAGE_LIST_KEY,
                '-inf',
                time(),
                ['withscores' => true]
            );

            $toRemScoreStack = [];

            if ($data != []) {
                foreach ($data as $message => $timestamp) {
                    fwrite(STDOUT, PHP_EOL . "MESSAGE TIME: $message" . PHP_EOL);

                    $toRemScoreStack[] = $timestamp;
                }

                $max = array_pop($toRemScoreStack);

                $this->redis->zRemRangeByScore(MessagePusherInterface::MESSAGE_LIST_KEY, '-inf', $max);
            } else {
                sleep(WORKER_SLEEP_TIME);
            }
        }
    }
}
