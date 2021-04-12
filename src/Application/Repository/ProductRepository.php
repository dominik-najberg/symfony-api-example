<?php declare(strict_types=1);

namespace App\Application\Repository;

use App\Domain\Product\Product;

interface ProductRepository
{
    public function add(Product $product): void;
}
