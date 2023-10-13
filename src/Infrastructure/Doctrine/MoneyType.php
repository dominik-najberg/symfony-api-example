<?php declare(strict_types=1);

namespace App\Infrastructure\Doctrine;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Money\Currency;
use Money\Money;

class MoneyType extends Type
{
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return 'BIGINT';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): Money
    {
        return new Money($value, new Currency('GBP')); // for demo purposes we will use only GBP
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return $value->getAmount();
    }

    public function getName(): string
    {
        return 'money';
    }
}
