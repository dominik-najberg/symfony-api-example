<?php

namespace App\Repository;

use App\Domain\Product\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $manager)
    {
        parent::__construct($manager, Product::class);
    }

    public function save(Product $product): void
    {
        $this->_em->persist($product);
        $this->_em->flush();
    }
}
