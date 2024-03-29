<?php declare(strict_types=1);

namespace App\UI\Http\Request;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;

class GetProductsRequest
{
    private function __construct(public readonly UuidInterface $categoryId)
    {
    }

    public static function fromRequest(Request $request): self
    {
        try {
            $categoryId = Uuid::fromString($request->query->get('category_id'));

            $self = new self($categoryId);
        } catch (\TypeError | \Exception $e) {
            throw new BadRequestException($e->getMessage());
        }

        return $self;
    }
}
