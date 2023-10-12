<?php declare(strict_types=1);

namespace App\Application\Command;

use App\Application\Repository\ProductRepository;
use App\Domain\Product\Event\ProductCreated;
use App\Domain\Product\Product;
use App\Domain\Product\Value\Description;
use App\Domain\Product\Value\Name;
use Money\Currency;
use Money\Money;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateProductHandler
{
    public function __construct(
        private readonly ProductRepository   $products,
        private readonly MessageBusInterface $messageBus,
    ) {
    }

    public function __invoke(CreateProduct $command)
    {
        $product = Product::create(
            $command->id,
            $command->categoryId,
            new Name($command->name),
            new Description($command->description),
            new Money($command->amount, new Currency($command->currency))
        );

        $this->products->add($product);

        $this->messageBus->dispatch(
            new ProductCreated(
                $command->id->toString(),
                $command->name,
                $command->description,
                $command->amount,
                $command->currency,
            )
        );
    }
}
