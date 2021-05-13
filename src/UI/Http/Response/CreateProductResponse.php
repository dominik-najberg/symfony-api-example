<?php declare(strict_types=1);

namespace App\UI\Http\Response;

use App\Application\Command\CreateProduct;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateProductResponse extends JsonResponse
{
    public static function fromCommand(CreateProduct $command): self
    {
        return new self(
            [
                'data' => [
                    'type' => 'products',
                    'id' => $command->id(),
                    'attributes' => [
                        'name' => $command->name(),
                        'description' => $command->description(),
                        'amount' => $command->amount(),
                        'currency' => $command->currency(),
                    ],
                ],
            ],
            Response::HTTP_CREATED,
        );
    }
}
