<?php declare(strict_types=1);

namespace App\Domain\Product\Exception;

class InvalidName extends \Exception
{
    public static function lengthRequirement(int $length): self
    {
        return new self(sprintf('maximum name length required: %d', $length));
    }
}
