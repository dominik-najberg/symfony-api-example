<?php declare(strict_types=1);

namespace App\Exception;

class InvalidName extends \Exception
{
    public static function lengthRequirement(int $length): InvalidName
    {
        return new self(sprintf('maximum name length required: %d', $length));
    }
}
