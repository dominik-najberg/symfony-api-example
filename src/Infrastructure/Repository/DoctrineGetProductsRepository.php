<?php declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Application\Exception\ProductsNotFoundException;
use App\Application\Query\ViewModel\ProductDTO;
use App\Application\Repository\GetProductsRepository;
use App\Domain\Product\Product;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

class DoctrineGetProductsRepository implements GetProductsRepository
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    /**
     * @throws ProductsNotFoundException
     */
    public function getByCategoryId(UuidInterface $categoryId): iterable
    {
        $products = $this->entityManager->createQueryBuilder()
            ->from(Product::class, 'p')
            ->select(
                sprintf(
                    'new %s(
                    p.id,
                    p.name,
                    p.description,
                    p.amount,
                    p.currency)',
                    ProductDTO::class
                )
            )
            ->where('p.categoryId = :categoryId')->setParameter('categoryId', $categoryId->toString())
            ->getQuery()
            ->getResult();

        if (empty($products)) {
            throw ProductsNotFoundException::fromCategoryId($categoryId->toString());
        }

        return $products;
    }
}
