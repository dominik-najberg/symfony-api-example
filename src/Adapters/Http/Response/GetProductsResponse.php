<?php declare(strict_types=1);

namespace App\Adapters\Http\Response;

use App\Application\Query\ViewModel\ProductDTO;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetProductsResponse extends JsonResponse
{
    public static function fromProductDTOs(array $products): GetProductsResponse
    {
        return new self(
            [
                'data' => array_map(
                    fn(ProductDTO $product): array => [
                        'type'       => 'products',
                        'id'         => $product->id(),
                        'attributes' => [
                            'title'       => $product->title(),
                            'description' => $product->description(),
                            'price'       => sprintf('%s %s', $product->amount(), $product->currency()),
                        ]
                    ],
                    $products
                ),
            ]
        );
    }
}