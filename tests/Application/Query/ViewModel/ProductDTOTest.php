<?php

namespace App\Tests\Application\Query\ViewModel;

use App\Application\Query\ViewModel\ProductDTO;
use PHPUnit\Framework\TestCase;

class ProductDTOTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreate(): void
    {
        $expectedId          = 'b02b5c75-9a50-42e4-8c2c-930334427b72';
        $expectedTitle       = 'test title';
        $expectedDescription = 'test description';
        $expectedAmount      = '1000';
        $expectedCurrency    = 'USD';

        $actual = new ProductDTO(
            $expectedId,
            $expectedTitle,
            $expectedDescription,
            $expectedAmount,
            $expectedCurrency
        );

        self::assertEquals($expectedId, $actual->id());
        self::assertEquals($expectedTitle, $actual->title());
        self::assertEquals($expectedDescription, $actual->description());
        self::assertEquals($expectedAmount, $actual->amount());
        self::assertEquals($expectedCurrency, $actual->currency());
    }
}
