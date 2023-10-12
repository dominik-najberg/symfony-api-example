<?php declare(strict_types=1);

namespace App\Infrastructure\MessageBus;

use App\Application\MessageBus\CommandBus;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerCommandBus implements CommandBus
{
    public function __construct(
        private readonly MessageBusInterface $commandBus,
    ) {
    }

    public function dispatch($message): void
    {
        $this->commandBus->dispatch($message);
    }
}
