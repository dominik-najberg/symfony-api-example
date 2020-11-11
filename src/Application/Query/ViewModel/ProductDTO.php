<?php declare(strict_types=1);

namespace App\Application\Query\ViewModel;

class ProductDTO
{
    private string $id;
    private string $title;
    private string $description;
    private string $amount;
    private string $currency;

    public function __construct(string $id, string $title, string $description, string $amount, string $currency)
    {
        $this->id          = $id;
        $this->title       = $title;
        $this->description = $description;
        $this->amount      = $amount;
        $this->currency    = $currency;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
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