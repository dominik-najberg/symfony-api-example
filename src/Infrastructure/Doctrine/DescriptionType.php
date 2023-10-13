<?php declare(strict_types=1);

namespace App\Infrastructure\Doctrine;

use App\Domain\Product\Value\Description;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class DescriptionType extends StringType
{
    public function convertToPHPValue($value, AbstractPlatform $platform): Description
    {
        return new Description($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?Description
    {
        return $value instanceof Description ? $value->description : null;
    }

    public function getName(): string
    {
        return 'description';
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
