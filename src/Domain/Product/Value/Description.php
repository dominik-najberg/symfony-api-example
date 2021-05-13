<?php declare(strict_types=1);

namespace App\Domain\Product\Value;

use App\Domain\Product\Exception\InvalidDescription;

class Description
{
    private const MINIMUM_LENGTH = 100;
    private const MAXIMUM_LENGTH = 255;
    private string $description;

    public function __construct(string $description)
    {
        if (strlen($description) < self::MINIMUM_LENGTH) {
            throw InvalidDescription::minLengthRequirement(self::MINIMUM_LENGTH);
        }

        if (strlen($description) >= self::MAXIMUM_LENGTH) {
            throw InvalidDescription::maxLengthRequirement(self::MAXIMUM_LENGTH);
        }

        $this->description = $description;
    }

    public function description(): string
    {
        return $this->description;
    }
}
