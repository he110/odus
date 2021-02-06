<?php

namespace App\Command;

use App\Event\TelegramMessageEvent;
use App\Service\Channels\TelegramService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Telegram\Bot\Objects\Update;

class ChannelsTelegramUpdateCommand extends Command
{
    protected static $defaultName = 'channels:telegram:update';

    private TelegramService $service;
    private EventDispatcherInterface $dispatcher;

    public function __construct(TelegramService $service, EventDispatcherInterface $dispatcher)
    {
        $this->service    = $service;
        $this->dispatcher = $dispatcher;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Gets updates from telegram server. For local usage only');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var Update $update */
        foreach ($this->service->getUpdates() as $update) {
            if ($update->has('message')) {
                $message = $update->getMessage();
                $event = new TelegramMessageEvent($message);
                $this->dispatcher->dispatch($event, TelegramMessageEvent::EVENT_NEW);
            }
        }

        return Command::SUCCESS;
    }
}
