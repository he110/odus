<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Builder\Message\TelegramMessageBuilder;
use App\Event\TelegramMessageEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class TelegramMessageSubscriber implements EventSubscriberInterface
{
    private TelegramMessageBuilder $builder;
    private MessageBusInterface $messageBus;

    public function __construct(TelegramMessageBuilder $builder, MessageBusInterface $messageBus)
    {
        $this->builder    = $builder;
        $this->messageBus = $messageBus;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            TelegramMessageEvent::EVENT_NEW => 'onNewMessage',
        ];
    }

    public function onNewMessage(TelegramMessageEvent $event): void
    {
        $message = $this->builder->createFromTelegramApiMessage($event->getMessage());
        $this->messageBus->dispatch($message);
    }
}
