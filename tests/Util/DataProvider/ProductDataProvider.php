<?php declare(strict_types=1);

namespace App\Tests\Util\DataProvider;

use App\Domain\Product\Product;
use App\Tests\Util\Assembler\ProductAssembler;

class ProductDataProvider
{
    private const NUMBER_OF_DOMAINS = 10;

    /**
     * @return Product[]
     */
    public static function products(): array
    {
        $products = [];

        for ($i = 0; $i < self::NUMBER_OF_DOMAINS; $i++) {
            $products[] = ProductAssembler::new()
                ->withName(sprintf('Interesting product %d', $i))
                ->withDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. ')
                ->withPriceInUSD(100 * $i)
                ->assemble();
        }

        return $products;
    }
}