<?php declare(strict_types=1);

namespace App\Event;

use App\Entity\Product;

class ProductCreated
{
    public const EVENT_NAME = 'product-created';

    private string $id;
    private string $name;
    private string $description;
    private string $amount;
    private string $currency;

    private function __construct(string $id, string $name, string $description, string $amount, string $currency)
    {
        $this->id          = $id;
        $this->name        = $name;
        $this->description = $description;
        $this->amount      = $amount;
        $this->currency    = $currency;
    }

    public static function fromProduct(Product $product): self
    {
        return new self(
            $product->id()->toString(),
            $product->name()->name(),
            $product->description()->description(),
            $product->price()->getAmount(),
            $product->price()->getCurrency()->getCode(),
        );
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function amount(): string
    {
        return $this->amount;
    }

    public function currency(): string
    {
        return $this->currency;
    }
}
