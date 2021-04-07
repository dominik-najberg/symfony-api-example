<?php declare(strict_types=1);

namespace App\Infrastructure\EventListener;

use App\Domain\Product\Event\ProductCreated;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class ProductCreatedListener implements MessageHandlerInterface
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    public function __invoke(ProductCreated $productCreated): void
    {
        $this->messageBus->dispatch(
            EventStoreMessage::create(
                ProductCreated::EVENT_NAME,
                [
                    'id'          => $productCreated->id(),
                    'name'        => $productCreated->name(),
                    'description' => $productCreated->description(),
                    // 'amount' => $productCreated->amount(), # GDPR
                    // 'currency' => $productCreated->currency(), # GDPR
                ]
            )
        );
    }
}
