<?php declare(strict_types=1);

namespace App\Adapters\Queue\Message;

class ProductArrived
{
    private string $productId;

    public function __construct(string $productId)
    {
        $this->productId = $productId;
    }

    public function productId(): string
    {
        return $this->productId;
    }
}
