<?php declare(strict_types=1);

namespace App\Application\Query\ViewModel;

class ProductDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $title,
        public readonly string $description,
        public readonly string $amount,
        public readonly string $currency,
    ) {
    }
}
