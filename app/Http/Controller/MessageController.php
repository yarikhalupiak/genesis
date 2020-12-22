<?php

declare(strict_types=1);

namespace App\Http\Controller;

use App\Core\Interfaces\RequestInterface;
use App\Core\Interfaces\ResponseInterface;
use App\Dto\MessageDto;
use App\Http\Request\MessageRequest;
use App\Service\MessagePusherInterface;

final class MessageController
{
    /** @var MessageRequest */
    private $request;

    /** @var ResponseInterface */
    private $response;

    /** @var MessagePusherInterface  */
    private $messagePusher;

    public function __construct(
        RequestInterface $request,
        ResponseInterface $response,
        MessagePusherInterface $messagePusher
    ) {
        $this->response = $response;
        $this->messagePusher = $messagePusher;

        $this->request = new MessageRequest($request);
    }

    public function __invoke(): ResponseInterface
    {
        $dto = new MessageDto(
            $this->request->getMessage(),
            $this->request->getDateTime()->getTimestamp()
        );

        $this->messagePusher->push($dto);

        $this->response->setOutput('Ok');

        return $this->response;
    }
}
