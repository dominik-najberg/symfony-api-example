<?php declare(strict_types=1);

namespace App\Domain\Product;

use App\Exception\InvalidDescription;
use App\Exception\InvalidName;
use Money\Currency;
use Money\Money;
use Ramsey\Uuid\UuidInterface;

class Product
{
    private UuidInterface $id;
    private UuidInterface $categoryId;
    private string $name;
    private string $description;
    private string $amount;
    private string $currency;

    public function __construct(
        UuidInterface $id,
        UuidInterface $categoryId,
        string $name,
        string $description,
        Money $price
    ) {
        if (strlen($description) < 100) {
            throw InvalidDescription::minLengthRequirement(100);
        }

        if (strlen($description) >= 255) {
            throw InvalidDescription::maxLengthRequirement(255);
        }

        if (strlen($name) > 100) {
            throw InvalidName::lengthRequirement(100);
        }

        $this->id = $id;
        $this->categoryId = $categoryId;
        $this->name = $name;
        $this->description = $description;
        $this->amount = $price->getAmount();
        $this->currency = $price->getCurrency()->getCode();
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

    public function price(): Money
    {
        return new Money($this->amount, new Currency($this->currency));
    }
}
