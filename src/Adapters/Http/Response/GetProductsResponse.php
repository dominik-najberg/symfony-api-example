<?php declare(strict_types=1);

namespace App\Adapters\Http\Response;

use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetProductsResponse extends JsonResponse
{
    public static function fromProductDTO(): GetProductsResponse
    {
        return new self(
            [
                'data' => [
                    'type'       => 'products',
                    'id'         => Uuid::uuid4(), // TODO fake for now
                    'attributes' => [
                        'name'        => 'that is a product',
                        'description' => 'The shortest article. Ever.',
                        'price'       => '100 PLN',
                    ],
                ],
            ]
        );
    }
}