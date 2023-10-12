<?php declare(strict_types=1);

namespace App\Domain\Product\Exception;

class InvalidDescription extends \Exception
{
    public static function minLengthRequirement(int $length): InvalidDescription
    {
        return new self(sprintf('minimum description length required: %d', $length));
    }

    public static function maxLengthRequirement(int $length): InvalidDescription
    {
        return new self(sprintf('maximum description length allowed: %d', $length));
    }
}
