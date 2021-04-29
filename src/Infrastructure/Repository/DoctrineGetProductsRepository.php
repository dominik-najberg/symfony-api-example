<?php declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Application\Exception\ProductsNotFoundException;
use App\Application\Query\ViewModel\ProductDTO;
use App\Domain\Product\Product;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

class DoctrineGetProductsRepository implements \App\Application\Repository\GetProductsRepository
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
                sprintf('new %s(t.content, t.dueDate)', ProductDTO::class)
            )
            ->where('t.taskListId = :userId')->setParameter('userId', $categoryId->toString())
            ->getQuery()
            ->getResult();

        if (empty($tasks)) {
            throw ProductsNotFoundException::fromCategoryId($categoryId->toString());
        }

        return $tasks;
    }
}