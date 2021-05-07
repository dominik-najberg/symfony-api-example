<?php

namespace App\Repository;

use App\Application\Query\ViewModel\ProductDTO;
use App\Application\Repository\ProductRepository;
use App\Application\Repository\ProductsViewRepository;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineProductRepository extends ServiceEntityRepository implements ProductRepository, ProductsViewRepository
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
