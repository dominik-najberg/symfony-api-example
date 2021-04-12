<?php declare(strict_types=1);

namespace App\Domain\Product\Value;

use App\Domain\Product\Exception\InvalidName;

class Name
{
    private const MAXIMUM_LENGTH = 100;

    private string $name;

    public function __construct(string $name)
    {
        if (strlen($name) > self::MAXIMUM_LENGTH) {
            throw InvalidName::lengthRequirement(self::MAXIMUM_LENGTH);
        }

        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }
}
