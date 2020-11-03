<?php

namespace App\Tests\Integration\Infrastructure\Repository;

use App\Domain\Product\Product;
use App\Infrastructure\Repository\DoctrineProductRepository;
use App\Tests\Integration\DbTestingTrait;
use App\Tests\Util\Assembler\ProductAssembler;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductRepositoryTest extends KernelTestCase
{
    use DbTestingTrait;

    private DoctrineProductRepository $repository;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->entityManager = self::$container->get('doctrine')->getManager();

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
