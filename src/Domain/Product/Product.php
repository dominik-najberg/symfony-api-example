<?php declare(strict_types=1);

namespace App\Domain\Product;

use App\Domain\Product\Value\Description;
use App\Domain\Product\Value\Name;
use Money\Money;
use Ramsey\Uuid\UuidInterface;

class Product
{
    private function __construct(
        private UuidInterface $id,
        private UuidInterface $categoryId,
        private Name          $name,
        private Description   $description,
        private Money         $price,
    ) {
    }

    public static function create(
        UuidInterface $id,
        UuidInterface $categoryId,
        Name        $name,
        Description $description,
        Money       $price
    ): self {
        return new self($id, $categoryId, $name, $description, $price);
    }

    public function rename($name): void
    {
        $this->name = $name;

        // any additional logic
    }
}
