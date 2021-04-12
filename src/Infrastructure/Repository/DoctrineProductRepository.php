<?php

namespace App\Infrastructure\Repository;

use App\Application\Query\ViewModel\ProductDTO;
use App\Application\Repository\ProductRepository;
use App\Application\Repository\ProductsViewRepository;
use App\Domain\Product\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineProductRepository extends ServiceEntityRepository implements ProductRepository, ProductsViewRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function save(Product $product): void
    {
        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush(); // TODO flush in a better moment
    }

    /**
     * @return ProductDTO[]
     */
    public function getProducts(): array
    {
        return
            $this
                ->createQueryBuilder('product')
                ->select(
                    sprintf(
                        'new %s(
                        product.id,
                        product.name,
                        product.description,
                        product.amount,
                        product.currency)',
                        ProductDTO::class
                    )
                )
                ->getQuery()
                ->getResult();
    }
}
