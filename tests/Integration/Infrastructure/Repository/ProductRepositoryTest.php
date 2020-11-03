<?php

namespace App\Tests\Integration\Infrastructure\Repository;

use App\Domain\Product\Product;
use App\Infrastructure\Repository\DoctrineProductRepository;
use App\Tests\Integration\DbTestCase;
use App\Tests\Util\Assembler\ProductAssembler;

class ProductRepositoryTest extends DbTestCase
{
    private DoctrineProductRepository $repository;

    protected function setUp(): void
    {
        self::bootKernel();

        /** @var DoctrineProductRepository $repository */
        $repository       = self::$container->get(DoctrineProductRepository::class);
        $this->repository = $repository;

        $this->truncateTable(Product::class);
    }

    /**
     * @test
     */
    public function shouldSaveToDB(): void
    {
        $expected = ProductAssembler::new()->assemble();
        $this->repository->save($expected);

        $actual = $this->entityManager->find(Product::class, $expected->id());
        self::assertEquals($actual, $expected);
    }
}
