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
    public function test_should_create(): void
    {
        $id = Uuid::uuid4();
        $categoryId = Uuid::uuid4();
        $name = new Name('product name');
        $description = new Description(str_repeat('product description ', 10));
        $price = Money::USD(1000);

        $actual = Product::create($id, $categoryId, $name, $description, $price);

        $reflection = new \ReflectionClass($actual);

        // Check id
        $idProperty = $reflection->getProperty('id');
        $actualId   = $idProperty->getValue($actual);
        self::assertEquals($id, $actualId);

        // Check categoryId
        $categoryIdProperty = $reflection->getProperty('categoryId');
        $actualCategoryId   = $categoryIdProperty->getValue($actual);
        self::assertEquals($categoryId, $actualCategoryId);

        // Check name
        $nameProperty = $reflection->getProperty('name');
        $actualName   = $nameProperty->getValue($actual);
        self::assertEquals($name, $actualName);

        // Check description
        $descriptionProperty = $reflection->getProperty('description');
        $actualDescription   = $descriptionProperty->getValue($actual);
        self::assertEquals($description, $actualDescription);

        // Check price
        $priceProperty = $reflection->getProperty('price');
        $actualPrice   = $priceProperty->getValue($actual);
        self::assertEquals($price, $actualPrice);
    }
}
