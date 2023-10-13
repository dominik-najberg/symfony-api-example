<?php declare(strict_types=1);

namespace App\Infrastructure\Doctrine;

use App\Domain\Product\Value\Name;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class NameType extends StringType
{
    public function convertToPHPValue($value, AbstractPlatform $platform): Name
    {
        return new Name($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?Name
    {
        return $value instanceof Name ? $value->name : null;
    }

    public function getName(): string
    {
        return 'name';
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}
