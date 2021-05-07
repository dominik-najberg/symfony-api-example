<?php declare(strict_types=1);

namespace App\Queue\Message;

class ProductArrived
{
    private string $productId;

    /**
     * This can translate a message from an external queue
     */
    public function __construct(string $productId)
    {
        $this->productId = $productId;
    }

    public function productId(): string
    {
        return $this->productId;
    }
}
