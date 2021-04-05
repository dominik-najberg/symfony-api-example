<?php declare(strict_types=1);

namespace App\Application\Command;

class CreateProduct
{
    private string $id;
    private string $name;
    private string $description;
    private int    $amount;
    private string $currency;

    public function __construct(string $id, string $name, string $description, int $amount, string $currency)
    {
        $this->id          = $id;
        $this->name        = $name;
        $this->description = $description;
        $this->amount      = $amount;
        $this->currency    = $currency;
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

    public function amount(): int
    {
        return $this->amount;
    }

    public function currency(): string
    {
        return $this->currency;
    }
}
