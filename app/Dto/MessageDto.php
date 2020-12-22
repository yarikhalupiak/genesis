<?php

declare(strict_types=1);

namespace App\Dto;

final class MessageDto
{
    private $timestamp;

    private $message;

    public function __construct(string $message, int $timestamp)
    {
        $this->message = $message;
        $this->timestamp = $timestamp;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }
}