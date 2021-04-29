<?php declare(strict_types=1);

namespace App\Application\Repository;

use App\Application\Query\ViewModel\ProductDTO;
use Ramsey\Uuid\UuidInterface;

interface GetProductsRepository
{
    /**
     * @return ProductDTO[]
     */
    public function getByCategoryId(UuidInterface $categoryId): iterable;
}