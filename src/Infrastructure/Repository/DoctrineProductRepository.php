<?php

namespace App\Infrastructure\Repository;

use App\Application\Query\GetProducts;
use App\Application\Query\ViewModel\ProductDTO;
use App\Application\Repository\ProductRepository;
use App\Domain\Product\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineProductRepository extends ServiceEntityRepository implements ProductRepository, GetProducts
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
                        product.name.name,
                        product.description.description,
                        product.amount,
                        product.currency)',
                        ProductDTO::class
                    )
                )
                ->getQuery()
                ->getResult();
    }
}
