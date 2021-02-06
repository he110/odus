<?php

declare(strict_types=1);

namespace App\Event;

use Symfony\Contracts\EventDispatcher\Event;
use Telegram\Bot\Objects\Message;

class TelegramMessageEvent extends Event
{
    public const EVENT_NEW = 'new';

    private Message $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * @return Message
     */
    public function getMessage(): Message
    {
        return $this->message;
    }
}
