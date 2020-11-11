<?php declare(strict_types=1);

namespace App\Application\Query;

use App\Domain\Product\Product;

interface GetProducts
{
    /**
     * @return Product[]
     */
    public function getProducts(): array;
}