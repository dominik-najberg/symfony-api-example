<?php declare(strict_types=1);

namespace App\Adapters\Http;

use App\Adapters\Http\Response\GetProductsResponse;
use App\Application\Query\GetProducts;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetProductsHttpAdapter
{
    private GetProducts $getProduct;

    public function __construct(GetProducts $getProduct)
    {
        $this->getProduct = $getProduct;
    }

    public function __invoke(): JsonResponse
    {
        $products = $this->getProduct->getProducts();

        return GetProductsResponse::fromProductDTOs($products);
    }
}