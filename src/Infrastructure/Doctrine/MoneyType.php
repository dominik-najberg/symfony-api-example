<?php declare(strict_types=1);

namespace App\Infrastructure\Doctrine;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Money\Money;

class MoneyType extends Type
{

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?Money
    {
        return $value instanceof Money ? $value->getAmount() : null;
    }

    public function getName(): string
    {
        return 'money';
    }

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'DECIMAL(10, 2)';
    }
}
