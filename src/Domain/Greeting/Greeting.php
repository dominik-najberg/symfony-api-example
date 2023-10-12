<?php declare(strict_types=1);

namespace App\Domain\Greeting;

class Greeting
{
    private const GREETING_TEMPLATE = 'Hello, %s!';

    private function __construct(
        private string $name,
    ) {
    }

    public static function fromName(string $name): Greeting
    {
        return new self($name);
    }

    public function greet(): string
    {
        return sprintf(self::GREETING_TEMPLATE, $this->name);
    }
}
