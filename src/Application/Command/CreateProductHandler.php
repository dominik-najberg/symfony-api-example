<?php declare(strict_types=1);

namespace App\Application\Command;

use App\Application\Repository\ProductRepository;
use App\Domain\Product\Event\ProductCreated;
use App\Domain\Product\Product;
use App\Domain\Product\Value\Description;
use App\Domain\Product\Value\Name;
use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateProductHandler implements MessageHandlerInterface
{
    private ProductRepository   $products;
    private MessageBusInterface $messageBus;

    public function __construct(ProductRepository $products, MessageBusInterface $messageBus)
    {
        $this->products   = $products;
        $this->messageBus = $messageBus;
    }

    public function __invoke(CreateProduct $command)
    {
        $product = Product::create(
            Uuid::fromString($command->id()),
            new Name($command->name()),
            new Description($command->description()),
            new Money($command->amount(), new Currency($command->currency()))
        );

        $this->products->add($product);

        $this->messageBus->dispatch(
            ProductCreated::fromProduct($product)
        );
    }
}
