<?php

namespace App\MessageHandler;

use App\Message\TelegramMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class TelegramMessageHandler implements MessageHandlerInterface
{
    public function __invoke(TelegramMessage $message)
    {
        //TODO
    }
}
