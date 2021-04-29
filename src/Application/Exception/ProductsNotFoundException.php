<?php declare(strict_types=1);

namespace App\Application\Exception;

class ProductsNotFoundException extends \Exception
{
    public static function fromCategoryId(string $categoryId): self
    {
        return new self(sprintf('No products found in category: %s', $categoryId));
    }
}