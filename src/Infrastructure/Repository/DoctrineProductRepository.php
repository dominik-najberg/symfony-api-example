<?php

namespace App\Infrastructure\Repository;

use App\Application\Query\ViewModel\ProductDTO;
use App\Application\Repository\ProductRepository;
use App\Domain\Product\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineProductRepository extends ServiceEntityRepository implements ProductRepository
{
    public function __construct(ManagerRegistry $manager)
    {
        parent::__construct($manager, Product::class);
    }

    public function add(Product $product): void
    {
        $this->_em->persist($product);
    }

    /**
     * @return ProductDTO[]
     */
    public function getProducts(): iterable
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
