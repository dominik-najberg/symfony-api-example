<?php declare(strict_types=1);

namespace App\Application\Query;

use App\Application\Query\ViewModel\ProductDTO;
use App\Application\Repository\GetProductsRepository;

class GetProductsHandler
{
    public function __construct(
        private readonly GetProductsRepository $products,
    ) {
    }

    /** @return ProductDTO[] */
    public function __invoke(GetProducts $query): iterable
    {
        return $this->products->getByCategoryId($query->categoryId);
    }
}
