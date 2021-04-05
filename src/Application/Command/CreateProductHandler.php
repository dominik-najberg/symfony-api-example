<?php declare(strict_types=1);

namespace App\Application\Command;

use App\Application\Repository\ProductRepository;
use App\Domain\Product\Description;
use App\Domain\Product\Name;
use App\Domain\Product\Product;
use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateProductHandler implements MessageHandlerInterface
{
    private ProductRepository $products;

    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
    }

    public function __invoke(CreateProduct $command)
    {
        $product = new Product(
            Uuid::fromString($command->id()),
            new Name($command->name()),
            new Description($command->description()),
            new Money($command->amount(), new Currency($command->currency()))
        );

        $this->products->save($product);
    }
}
