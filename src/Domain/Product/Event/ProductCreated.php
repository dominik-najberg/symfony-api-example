<?php declare(strict_types=1);

namespace App\Domain\Product\Event;

class ProductCreated
{
    public const EVENT_NAME = 'product-created';

    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $description,
        public readonly int    $amount,
        public readonly string $currency,
    ) {
    }
}
