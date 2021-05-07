<?php declare(strict_types=1);

namespace App\Queue;

use App\Application\Command\CreateProduct;
use App\Queue\Message\ProductArrived;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Messenger\MessageBusInterface;

class AddProductMessageAdapter
{
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    // string can be a message from an external queue (Amazon SQS)
    public function __invoke(string $uuid): void
    {
        $productArrived = new ProductArrived($uuid);

        $this->commandBus->dispatch(
            new CreateProduct(
                Uuid::fromString($productArrived->productId()),
                Uuid::uuid4(),
                'name',
                str_repeat('From queue', 10),
                100,
                'USD'
            )
        );
    }
}
