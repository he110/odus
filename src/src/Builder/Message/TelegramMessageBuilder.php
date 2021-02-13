<?php

declare(strict_types=1);

namespace App\Builder\Message;

use App\Builder\Entity\ChatUserBuilder;
use App\Message\TelegramMessage;
use App\Reference\ChatUserReference;
use DateTime;
use Telegram\Bot\Objects\Message;

class TelegramMessageBuilder
{
    /** @var ChatUserBuilder */
    private ChatUserBuilder $chatUserBuilder;

    public function __construct(ChatUserBuilder $chatUserBuilder)
    {
        $this->chatUserBuilder    = $chatUserBuilder;
    }

    public function createFromTelegramApiMessage(Message $apiMessage): TelegramMessage
    {
        //TODO: Implement this
    }
}
