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

    /**
     * @return Product[]
     */
    public static function singleProduct(): array
    {
        return [ProductAssembler::new()
            ->withId('82e00d1b-b8a9-4011-a5aa-a5e92c3e2021')
            ->withName('One interesting product')
            ->withDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. ')
            ->withPriceInUSD(1000)
            ->assemble()
        ];
    }
}