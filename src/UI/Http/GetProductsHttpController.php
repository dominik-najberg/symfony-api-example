<?php declare(strict_types=1);

namespace App\UI\Http;

use App\Application\MessageBus\QueryBus;
use App\Application\Query\GetProducts;
use App\Application\Query\ViewModel\ProductDTO;
use App\UI\Http\Request\GetProductsRequest;
use App\UI\Http\Response\GetProductsResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetProductsHttpController
{
    private QueryBus $queryBus;

    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    public function __invoke(GetProductsRequest $request): JsonResponse
    {
        /** @var ProductDTO[] $products */
        $products = $this->queryBus->query(new GetProducts($request->categoryId()));

        return GetProductsResponse::fromProductDTOs($products);
    }
}
