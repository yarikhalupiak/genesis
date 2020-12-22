<?php

declare(strict_types=1);

namespace App\Http\Request;

use App\Core\Interfaces\RequestInterface;
use DateTime;
use Exception;
use RuntimeException;

final class MessageRequest
{
    /** @var RequestInterface */
    private $request;

    /** @var string */
    private $message;

    /** @var DateTime */
    private $dateTime;

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
        $this->init();
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getDateTime(): DateTime
    {
        return $this->dateTime;
    }

    private function init(): void
    {
        $message = $this->request->getQueryParam('message');
        $dateTime = $this->request->getQueryParam('dateTime');

        $this->validate($message, $dateTime);

        $this->message = (string) $message;
        $this->dateTime = new DateTime($dateTime);
    }

    private function validate($message, $dateTime): void
    {
        $isValid = true;

        if ($message === null || $dateTime === null) {
            $isValid = false;
        }

        try {
            if ((new DateTime($dateTime))->getTimestamp() < time()) {
                $isValid = false;
            }
        } catch (Exception $e) {
            $isValid = false;
        }

        if (! $isValid) {
            throw new RuntimeException('Invalid request');
        }
    }
}
