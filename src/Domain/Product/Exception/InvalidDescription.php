<?php declare(strict_types=1);

namespace App\Domain\Product\Exception;

class InvalidDescription extends \Exception
{
    public static function lengthRequirement(int $description): InvalidDescription
    {
        return new self(sprintf('minimum description length required: %d', $description));
    }
}