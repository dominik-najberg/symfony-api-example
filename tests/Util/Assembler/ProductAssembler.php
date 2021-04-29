<?php declare(strict_types=1);

namespace App\Tests\Util\Assembler;

use App\Domain\Product\Product;
use App\Domain\Product\Value\Description;
use App\Domain\Product\Value\Name;
use Money\Money;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class ProductAssembler
{
    private const USER_ID = '302d1503-dc2f-4f3b-9350-21ce2ee55f1c';

    private UuidInterface $id;
    private UuidInterface $userId;
    private Name $name;
    private Description $description;
    private Money $price;

    private function __construct(
        UuidInterface $id,
        UuidInterface $userId,
        Name $name,
        Description $description,
        Money $price
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    public static function new(): ProductAssembler
    {
        return new self(
            Uuid::uuid4(),
            Uuid::fromString(self::USER_ID),
            new Name('product name'),
            new Description(str_repeat('description', 10)),
            Money::USD(700),
        );
    }

    public function assemble(): Product
    {
        return Product::create(
            $this->id,
            $this->userId,
            $this->name,
            $this->description,
            $this->price,
        );
    }

    public function withId(string $id): ProductAssembler
    {
        $this->id = Uuid::fromString($id);

        return $this;
    }

    public function withName(string $name): ProductAssembler
    {
        $this->name = new Name($name);

        return $this;
    }

    public function withDescription(string $description): ProductAssembler
    {
        $this->description = new Description(substr(str_repeat($description, 5), 0, 254));

        return $this;
    }

    public function withPriceInUSD(int $amount): ProductAssembler
    {
        $this->price = Money::USD($amount);

        return $this;
    }
}
