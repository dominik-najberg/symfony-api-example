<?php declare(strict_types=1);

namespace App\UI\Http\Request;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;

class GetProductsRequest
{
    private UuidInterface $categoryId;

    private function __construct(UuidInterface $categoryId)
    {
        $this->categoryId = $categoryId;
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

    public function categoryId(): UuidInterface
    {
        return $this->categoryId;
    }
}