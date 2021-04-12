<?php declare(strict_types=1);

namespace App\Adapters\Http\Request;

use App\Domain\Product\Value\Description;
use App\Domain\Product\Value\Name;
use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;

class CreateProductRequest
{
    private string $id;
    private string $name;
    private string $description;
    private int    $amount;
    private string $currency;

    private function __construct(string $id, string $name, string $description, int $amount, string $currency)
    {
        $this->id          = $id;
        $this->name        = $name;
        $this->description = $description;
        $this->amount      = $amount;
        $this->currency    = $currency;
    }

    public static function fromRequest(Request $request): self
    {
        try {
            $id           = Uuid::fromString($request->request->get('id'));
            $name         = new Name($request->request->get('name'));
            $description  = new Description($request->request->get('description'));
            $amount       = (int)$request->request->get('amount');
            $currencyCode = $request->request->get('currency');
            $money        = new Money($amount, new Currency($currencyCode));

            $self = new self(
                $id->toString(),
                $name->name(),
                $description->description(),
                (int)$money->getAmount(),
                $money->getCurrency()->getCode(),
            );
        } catch (\TypeError|\Exception $e) {
            throw new BadRequestException($e->getMessage());
        }

        return $self;
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
