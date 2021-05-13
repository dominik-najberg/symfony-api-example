<?php

namespace App\Infrastructure\Repository;

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
}
