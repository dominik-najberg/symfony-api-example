<?php declare(strict_types=1);

namespace App\Application\Command;

use Ramsey\Uuid\UuidInterface;

class CreateProduct
{
    public function __construct(
        public readonly UuidInterface $id,
        public readonly UuidInterface $categoryId,
        public readonly string        $name,
        public readonly string        $description,
        public readonly int           $amount,
        public readonly string        $currency,
    ) {
    }
}
