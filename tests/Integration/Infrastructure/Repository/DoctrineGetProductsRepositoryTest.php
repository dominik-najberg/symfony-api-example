<?php declare(strict_types=1);

namespace App\Tests\Integration\Infrastructure\Repository;

use App\Application\Exception\ProductsNotFoundException;
use App\Domain\Product\Product;
use App\Repository\DoctrineGetProductsRepository;
use App\Tests\Integration\DbTestCase;
use App\Tests\Util\DataProvider\ProductDataProvider;
use Ramsey\Uuid\Uuid;

class DoctrineGetProductsRepositoryTest extends DbTestCase
{
    private DoctrineGetProductsRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->repository = new DoctrineGetProductsRepository($this->entityManager);
        $this->truncateTable(Product::class);
        $this->seedDb(ProductDataProvider::products());
    }

    /**
     * @test
     */
    public function should_get_products(): void
    {
        $tasks = $this->repository->getByCategoryId(Uuid::fromString(ProductDataProvider::CATEGORY_ID));

        self::assertCount(ProductDataProvider::NUMBER_OF_PRODUCTS, $tasks);
    }

    /**
     * @test
     */
    public function should_throw_on_not_found(): void
    {
        $this->expectException(ProductsNotFoundException::class);
        $this->repository->getByCategoryId(Uuid::uuid4());
    }
}