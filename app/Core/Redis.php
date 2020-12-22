<?php

declare(strict_types=1);

namespace App\Core;

use App\Core\Interfaces\RedisInterface;
use Predis;

class Redis implements RedisInterface
{
    private $client;

    public function __construct(
        $host = REDIS_HOST,
        $port = REDIS_PORT,
        $database = REDIS_DATABASE
    ) {
        $client = new Predis\Client(
            [
                'scheme' => 'tcp',
                'host' => $host,
                'port' => $port,
                'database' => $database
            ]
        );

        $this->client = $client;
    }

    public function zAdd(string $key, $score, $member): void
    {
        $this->client->zadd($key, $score, $member);
    }

    public function zRangeByScore(string $key, $min, $max, array $options = null): array
    {
        return $this->client->zrangebyscore($key, $min, $max, (array)$options);
    }

    public function zRemRangeByScore(string $key, $min, $max): void
    {
        $this->client->zremrangebyscore($key, $min, $max);
    }
}