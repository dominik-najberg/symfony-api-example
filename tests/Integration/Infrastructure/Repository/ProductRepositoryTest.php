<?php

namespace App\Tests\Integration\Infrastructure\Repository;

use App\Domain\Product\Product;
use App\Infrastructure\Repository\DoctrineProductRepository;
use App\Tests\Util\Assembler\ProductAssembler;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductRepositoryTest extends KernelTestCase
{
    private DoctrineProductRepository $repository;
    private EntityManager             $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        /** @var DoctrineProductRepository $repository */
        $repository       = $this->entityManager->getRepository(Product::class);
        $this->repository = $repository;
    }

    /**
     * @test
     */
    public function shouldSaveToDB(): void
    {
        $expected = ProductAssembler::new()->assemble();
        $this->repository->save($expected);

        $this->entityManager->flush();

        $actual = $this->entityManager->find(Product::class, $expected->id());
        self::assertEquals($actual, $expected);
    }

}
