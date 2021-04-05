<?php declare(strict_types=1);

namespace App\Application\Query;

use App\Application\Query\ViewModel\ProductDTO;

interface GetProducts
{
    /**
     * @return ProductDTO[]
     */
    public function getProducts(): array;
}
