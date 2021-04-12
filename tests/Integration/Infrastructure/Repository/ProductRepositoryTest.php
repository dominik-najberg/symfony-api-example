<?php

namespace App\Tests\Integration\Infrastructure\Repository;

use App\Domain\Product\Product;
use App\Infrastructure\Repository\DoctrineProductRepository;
use App\Tests\Integration\DbTestCase;
use App\Tests\Util\Assembler\ProductAssembler;
use App\Tests\Util\DataProvider\ProductDataProvider;
use Doctrine\ORM\EntityManagerInterface;

class ProductRepositoryTest extends DbTestCase
{
    private EntityManagerInterface    $manager;
    private DoctrineProductRepository $repository;

    protected function setUp(): void
    {
        self::bootKernel();

        $this->manager    = self::$container->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Product::class);

        $this->truncateTable(Product::class);
        $this->seedDb(ProductDataProvider::products());
    }

    /**
     * @test
     */
    public function shouldSaveToDB(): void
    {
        $expected = ProductAssembler::new()->assemble();
        $this->repository->add($expected);
        $this->manager->flush();
        $this->manager->clear();

        $actual = $this->entityManager->find(Product::class, $expected->id());
        self::assertEquals($actual, $expected);
    }
}
