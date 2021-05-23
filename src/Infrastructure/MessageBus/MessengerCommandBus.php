<?php declare(strict_types=1);

namespace App\Infrastructure\MessageBus;

use App\Application\MessageBus\CommandBus;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerCommandBus implements CommandBus
{
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param $message
     */
    public function dispatch($message): void
    {
        $this->commandBus->dispatch($message);
    }
}