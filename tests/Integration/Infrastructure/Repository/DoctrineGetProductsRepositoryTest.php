<?php declare(strict_types=1);

namespace App\Tests\Integration\Infrastructure\Repository;

use App\Infrastructure\Repository\DoctrineGetProductsRepository;
use App\Tests\Integration\DbTestCase;

class DoctrineGetProductsRepositoryTest extends DbTestCase
{
    private DoctrineGetProductsRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = new DoctrineGetProductsRepository($this->entityManager);
    }


}