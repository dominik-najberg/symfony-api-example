<?php

namespace App\Tests\Integration\Infrastructure\Repository;

use App\Domain\Product\Product;
use App\Repository\DoctrineProductRepository;
use App\Tests\Integration\DbTestCase;
use App\Tests\Util\Assembler\ProductAssembler;
use App\Tests\Util\DataProvider\ProductDataProvider;

class DoctrineProductRepositoryTest extends DbTestCase
{
    private DoctrineProductRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = $this->entityManager->getRepository(Product::class);

        $this->truncateTable(Product::class);
        $this->seedDb(ProductDataProvider::products());
    }

    /**
     * @test
     */
    public function shouldSaveToDB(): void
    {
        $expected = ProductAssembler::new()->assemble();
        $this->repository->save($expected);
        $this->entityManager->flush();
        $this->entityManager->clear();

        $actual = $this->entityManager->find(Product::class, $expected->id());
        self::assertEquals($actual, $expected);
    }
}
