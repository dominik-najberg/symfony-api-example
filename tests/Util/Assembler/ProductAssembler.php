<?php declare(strict_types=1);

namespace App\Tests\Util\Assembler;

use App\Domain\Product\Description;
use App\Domain\Product\Name;
use App\Domain\Product\Product;
use Money\Money;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class ProductAssembler
{
    private UuidInterface $id;
    private Name          $name;
    private Description   $description;
    private Money         $price;

    private function __construct(UuidInterface $id, Name $name, Description $description, Money $price)
    {
        $this->id          = $id;
        $this->name        = $name;
        $this->description = $description;
        $this->price       = $price;
    }

    public static function new(): ProductAssembler
    {
        return new self(
            Uuid::uuid4(),
            new Name('product name'),
            new Description(str_repeat('description', 10)),
            Money::USD(700),
        );
    }

    public function assemble(): Product
    {
        return new Product(
            $this->id,
            $this->name,
            $this->description,
            $this->price,
        );
    }
}