<?php declare(strict_types=1);

namespace App\Application\Query;

use Ramsey\Uuid\UuidInterface;

class GetProducts
{
    public function __construct(
        public readonly UuidInterface $categoryId,
    ) {
    }
}
