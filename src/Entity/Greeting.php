<?php declare(strict_types=1);

namespace App\Entity;

class Greeting
{
    private const GREETING_TEMPLATE = 'Hello, %s!';
    private string $name;

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function byName(string $name): Greeting
    {
        return new self($name);
    }

    public function greet(): string
    {
        return sprintf(self::GREETING_TEMPLATE, $this->name);
    }
}
