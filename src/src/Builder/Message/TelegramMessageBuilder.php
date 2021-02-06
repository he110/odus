<?php

declare(strict_types=1);

namespace App\Builder\Message;

use App\Builder\Entity\ChatUserBuilder;
use App\Message\TelegramMessage;
use App\Reference\ChatUserReference;
use App\Repository\ChatUserRepository;
use DateTime;
use Telegram\Bot\Objects\Message;

class TelegramMessageBuilder
{
    /** @var ChatUserRepository */
    private ChatUserRepository $chatUserRepository;

    /** @var ChatUserBuilder */
    private ChatUserBuilder $chatUserBuilder;

    public function __construct(ChatUserRepository $chatUserRepository, ChatUserBuilder $chatUserBuilder)
    {
        $this->chatUserRepository = $chatUserRepository;
        $this->chatUserBuilder    = $chatUserBuilder;
    }

    public function createFromTelegramApiMessage(Message $apiMessage): TelegramMessage
    {
        $telegramUser = $apiMessage->get('from');

        $uid  = $telegramUser->get('uid') ?: '';
        $user = $this->chatUserRepository->findChatUser($uid, ChatUserReference::CHANNEL_TYPE_TELEGRAM);

        if ($user === null) {
            $user = $this->chatUserBuilder->createFromTelegramUser($telegramUser);
        }

        $date = new DateTime();
        $date->setTimestamp($apiMessage->get('date'));
        $message = new TelegramMessage();

        return $message->setUser($user)
            ->setMessage($apiMessage->get('text'))
            ->setDate($date)
            ->setIsFromBot(false);
    }
}
