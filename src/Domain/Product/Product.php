<?php declare(strict_types=1);

namespace App\Domain\Product;

use App\Domain\Product\Value\Description;
use App\Domain\Product\Value\Name;
use Money\Currency;
use Money\Money;
use Ramsey\Uuid\UuidInterface;

class Product
{
    private UuidInterface $id;
    private string        $name;
    private string        $description;
    private string        $amount;
    private string        $currency;

    private function __construct(UuidInterface $id, Name $name, Description $description, Money $price)
    {
        $this->id          = $id;
        $this->name        = $name->name();
        $this->description = $description->description();
        $this->amount      = $price->getAmount();
        $this->currency    = $price->getCurrency()->getCode();
    }

    public static function create(UuidInterface $id, Name $name, Description $description, Money $price): self
    {
        return new self($id, $name, $description, $price);
    }

    public function id(): UuidInterface
    {
        return $this->id;
    }

    public function name(): Name
    {
        return new Name($this->name);
    }

    public function description(): Description
    {
        return new Description($this->description);
    }

    public function price(): Money
    {
        return new Money($this->amount, new Currency($this->currency));
    }
}
