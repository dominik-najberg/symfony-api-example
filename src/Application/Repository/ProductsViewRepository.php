<?php

namespace App\Application\Repository;

use App\Application\Query\ViewModel\ProductDTO;

interface ProductsViewRepository
{
    /**
     * @return ProductDTO[]
     */
    public function getProducts(): array;
}
