<?php

declare(strict_types=1);

namespace App\Builder\Entity;

use App\Entity\ChatUser;
use App\Reference\ChatUserReference;
use LogicException;
use Telegram\Bot\Objects\User;

class ChatUserBuilder
{
    public function createFromTelegramUser(User $telegramUser): ChatUser
    {
        if (!$telegramUser->has('id') || !$telegramUser->has('first_name')) {
            throw new LogicException('Incomplete telegram user');
        }

        $user = new ChatUser();

        return $user->setChannelType(ChatUserReference::CHANNEL_TYPE_TELEGRAM)
            ->setUid((string)$telegramUser->get('id'))
            ->setName($telegramUser->get('first_name'));
    }
}
