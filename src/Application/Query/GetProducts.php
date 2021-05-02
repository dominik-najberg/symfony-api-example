<?php declare(strict_types=1);

namespace App\Application\Query;

use Ramsey\Uuid\UuidInterface;

class GetProducts
{
    private UuidInterface $categoryId;

    public function __construct(UuidInterface $categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function categoryId(): UuidInterface
    {
        return $this->categoryId;
    }
}
