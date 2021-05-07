<?php declare(strict_types=1);

namespace App\Repository;

use App\Application\Exception\ProductsNotFoundException;
use App\Application\Query\ViewModel\ProductDTO;
use App\Application\Repository\GetProductsRepository;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

class DoctrineGetProductsRepository implements GetProductsRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @throws ProductsNotFoundException
     */
    public function getByCategoryId(UuidInterface $categoryId): iterable
    {
        $tasks = $this->entityManager->createQueryBuilder()
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

        if (empty($tasks)) {
            throw ProductsNotFoundException::fromCategoryId($categoryId->toString());
        }

        return $tasks;
    }
}