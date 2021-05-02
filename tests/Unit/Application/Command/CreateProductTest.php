<?php declare(strict_types=1);

namespace App\Tests\Unit\Application\Command;

use App\Application\Command\CreateProduct;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class CreateProductTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreate(): void
    {
        $id = Uuid::uuid4();
        $categoryId = Uuid::uuid4();
        $name = 'name';
        $description = 'description';
        $amount = 123;
        $currency = 'PLN';

        $actual = new CreateProduct($id, $categoryId, $name, $description, $amount, $currency);

        self::assertEquals($id, $actual->id());
        self::assertEquals($categoryId, $actual->categoryId());
        self::assertEquals($name, $actual->name());
        self::assertEquals($description, $actual->description());
        self::assertEquals($amount, $actual->amount());
        self::assertEquals($currency, $actual->currency());
    }

}
