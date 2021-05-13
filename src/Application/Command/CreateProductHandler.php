<?php declare(strict_types=1);

namespace App\Application\Command;

use App\Application\Repository\ProductRepository;
use App\Domain\Product\Product;
use App\Domain\Product\Value\Description;
use App\Domain\Product\Value\Name;
use Money\Currency;
use Money\Money;
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
        $product = Product::create(
            $command->id(),
            $command->categoryId(),
            new Name($command->name()),
            new Description($command->description()),
            new Money($command->amount(), new Currency($command->currency()))
        );

        $this->products->add($product);
    }
}
