<?php declare(strict_types=1);

namespace App\Tests\Util\DataProvider;

use App\Entity\Product;
use App\Tests\Util\Assembler\ProductAssembler;

class ProductDataProvider
{
    public const CATEGORY_ID = 'abd98fa1-b102-4664-8c69-719dd8184d03';
    public const NUMBER_OF_PRODUCTS = 10;

    /**
     * @return Product[]
     */
    public static function products(): array
    {
        $products = [];

        for ($i = 0; $i < self::NUMBER_OF_PRODUCTS; $i++) {
            $products[] = ProductAssembler::new()
                ->withName(sprintf('Interesting product %d', $i))
                ->withCategoryId(self::CATEGORY_ID)
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
        return [
            ProductAssembler::new()
                ->withId('82e00d1b-b8a9-4011-a5aa-a5e92c3e2021')
                ->withCategoryId(self::CATEGORY_ID)
            ->withName('One interesting product')
            ->withDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit. ')
            ->withPriceInUSD(1000)
            ->assemble()
        ];
    }
}