<?php

declare(strict_types=1);

namespace App\Core\Interfaces;

interface RedisInterface
{
    public function zAdd(string $key, $score, $member): void;

    public function zRangeByScore(string $key, $min, $max, array $options = null): array;

    public function zRemRangeByScore(string $key, $min, $max): void;
}