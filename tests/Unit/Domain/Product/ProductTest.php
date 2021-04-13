<?php

namespace App\Tests\Unit\Domain\Product;

use App\Domain\Product\Product;
use App\Domain\Product\Value\Description;
use App\Domain\Product\Value\Name;
use Money\Money;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class ProductTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreate(): void
    {
        $id          = Uuid::uuid4();
        $name        = new Name('product name');
        $description = new Description(str_repeat('product description ', 10));
        $price       = Money::USD(1000);

        $actual = Product::create($id, $name, $description, $price);

        self::assertEquals($id, $actual->id());
        self::assertEquals($name, $actual->name());
        self::assertEquals($description, $actual->description());
        self::assertEquals($price, $actual->price());
    }
}
