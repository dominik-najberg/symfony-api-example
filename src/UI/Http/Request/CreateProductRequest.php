<?php declare(strict_types=1);

namespace App\UI\Http\Request;

use App\Domain\Product\Value\Description;
use App\Domain\Product\Value\Name;
use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;

class CreateProductRequest
{
    private function __construct(
        public readonly UuidInterface $id,
        public readonly UuidInterface $categoryId,
        public readonly string        $name,
        public readonly string        $description,
        public readonly int           $amount,
        public readonly string        $currency
    ) {
    }


    public static function fromRequest(Request $request): self
    {
        try {
            $id = Uuid::fromString($request->request->get('id'));
            $categoryId = Uuid::fromString($request->request->get('categoryId'));
            $name = new Name($request->request->get('name'));
            $description = new Description($request->request->get('description'));
            $amount = (int)$request->request->get('amount');
            $currencyCode = $request->request->get('currency');
            $money = new Money($amount, new Currency($currencyCode));

            $createProductRequest = new self(
                $id,
                $categoryId,
                $name->name,
                $description->description,
                (int)$money->getAmount(),
                $money->getCurrency()->getCode(),
            );
        } catch (\TypeError|\Exception $e) {
            throw new BadRequestException($e->getMessage());
        }

        return $createProductRequest;
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
