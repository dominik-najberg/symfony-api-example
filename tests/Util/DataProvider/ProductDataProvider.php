<?php declare(strict_types=1);

namespace App\Tests\Util\DataProvider;

use App\Domain\Product\Description;
use App\Domain\Product\Name;
use App\Domain\Product\Product;
use Money\Money;
use Ramsey\Uuid\Uuid;

class ProductDataProvider
{
    /**
     * @return Product[]
     */
    public static function products(): array
    {
        $products = [];

        for ($i = 0; $i < 10; $i++) {
            $products[] = new Product(
                Uuid::uuid4(),
                new Name(sprintf('Interesting product %d', $i)),
                new Description(str_repeat(sprintf('Lorem ipsum dolor sit amet, consectetur adipiscing elit. '), 20)),
                Money::USD(100 * $i)
            );
        }

        return $products;
    }
}