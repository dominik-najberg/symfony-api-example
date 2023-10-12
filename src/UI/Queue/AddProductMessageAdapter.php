<?php declare(strict_types=1);

namespace App\UI\Queue;

use App\Application\Command\CreateProduct;
use App\UI\Queue\Message\ProductArrived;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class AddProductMessageAdapter
{
    public function __construct(private readonly MessageBusInterface $commandBus)
    {
    }

    public function __invoke(UuidInterface $uuid): void
    {
        $productArrived = new ProductArrived($uuid);

        $this->commandBus->dispatch(
            new CreateProduct(
                Uuid::uuid4(), // simplification for demo purposes
                $productArrived->categoryId,
                'name',
                str_repeat('From queue', 10),
                100,
                'USD'
            )
        );
    }
}
