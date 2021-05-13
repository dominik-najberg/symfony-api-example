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
    private const CATEGORY_ID = '302d1503-dc2f-4f3b-9350-21ce2ee55f1c';

    private UuidInterface $id;
    private UuidInterface $categoryId;
    private string $name;
    private string $description;
    private Money $price;

    private function __construct(
        UuidInterface $id,
        UuidInterface $categoryId,
        string $name,
        string $description,
        Money $price
    ) {
        $this->id = $id;
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    public static function new(): ProductAssembler
    {
        return new self(
            Uuid::uuid4(),
            Uuid::fromString(self::CATEGORY_ID),
            'product name',
            str_repeat('description', 10),
            Money::USD(700),
        );
    }

    public function assemble(): Product
    {
        return new Product(
            $this->id,
            $this->categoryId,
            new Name($this->name),
            new Description($this->description),
            $this->price,
        );
    }

    public function withId(string $id): ProductAssembler
    {
        $this->id = Uuid::fromString($id);

        return $this;
    }

    public function withCategoryId(string $categoryId): ProductAssembler
    {
        $this->categoryId = Uuid::fromString($categoryId);

        return $this;
    }

    public function withName(string $name): ProductAssembler
    {
        $this->name = $name;

        return $this;
    }

    public function withDescription(string $description): ProductAssembler
    {
        $this->description = substr(str_repeat($description, 5), 0, 254);

        return $this;
    }

    public function withPriceInUSD(int $amount): ProductAssembler
    {
        $this->price = Money::USD($amount);

        return $this;
    }
}
