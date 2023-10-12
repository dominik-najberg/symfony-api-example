<?php

namespace App\Infrastructure\MessageBus;

use App\Application\MessageBus\QueryBus;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerQueryBus implements QueryBus
{

    public function __construct(
        private MessageBusInterface $messageBus
    ) {
    }

    public function query($query): mixed
    {
        if ($query instanceof Envelope) {
            return $this->messageBus->dispatch($query)->last();
        }

        return $this->messageBus->dispatch(new Envelope($query))->last();
    }

}
