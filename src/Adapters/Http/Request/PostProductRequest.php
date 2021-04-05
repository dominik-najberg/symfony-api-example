<?php declare(strict_types=1);

namespace App\Adapters\Http\Request;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;

class PostProductRequest
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
        $id          = $request->request->get('id');
        $name        = $request->request->get('name');
        $description = $request->request->get('description');
        $amount      = (int)$request->request->get('amount');
        $currency    = $request->request->get('currency');

        try {
            $self = new self($id, $name, $description, $amount, $currency);
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
