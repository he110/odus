<?php

declare(strict_types=1);

namespace App\Message;

use App\Entity\ChatUser;
use DateTime;

class BaseMessage
{
    private string $message;
    private bool $isFromBot = true;
    private DateTime $date;
    private ChatUser $user;

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return self
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFromBot(): bool
    {
        return $this->isFromBot;
    }

    /**
     * @param bool $isFromBot
     *
     * @return self
     */
    public function setIsFromBot(bool $isFromBot): self
    {
        $this->isFromBot = $isFromBot;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     *
     * @return self
     */
    public function setDate(DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return ChatUser
     */
    public function getUser(): ChatUser
    {
        return $this->user;
    }

    /**
     * @param ChatUser $user
     *
     * @return self
     */
    public function setUser(ChatUser $user): self
    {
        $this->user = $user;

        return $this;
    }
}
