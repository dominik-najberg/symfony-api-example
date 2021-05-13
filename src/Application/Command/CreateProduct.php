<?php declare(strict_types=1);

namespace App\Application\Command;

use Ramsey\Uuid\UuidInterface;

class CreateProduct
{
    private UuidInterface $id;
    private UuidInterface $categoryId;
    private string $name;
    private string $description;
    private int $amount;
    private string $currency;

    public function __construct(
        UuidInterface $id,
        UuidInterface $categoryId,
        string $name,
        string $description,
        int $amount,
        string $currency
    ) {
        $this->id = $id;
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->description = $description;
        $this->amount = $amount;
        $this->currency = $currency;
    }

    public function id(): UuidInterface
    {
        return $this->id;
    }

    public function categoryId(): UuidInterface
    {
        return $this->categoryId;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function amount(): int
    {
        return $this->amount;
    }

    public function currency(): string
    {
        return $this->currency;
    }
}
