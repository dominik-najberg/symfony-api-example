<?php declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Application\Exception\ProductsNotFoundException;
use App\Application\Query\ViewModel\ProductDTO;
use App\Application\Repository\GetProductsRepository;
use App\Domain\Product\Product;
use App\Domain\Product\Value\Description;
use App\Domain\Product\Value\Name;
use Doctrine\ORM\EntityManagerInterface;
use Money\Money;
use Ramsey\Uuid\UuidInterface;

class DoctrineGetProductsRepository implements GetProductsRepository
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    /**
     * @throws ProductsNotFoundException
     */
    public function getByCategoryId(UuidInterface $categoryId): iterable
    {
        $productRows = $this->entityManager->createQueryBuilder()
            ->from(Product::class, 'p')
            ->select('p.id', 'p.name', 'p.description', 'p.price')
            ->where('p.categoryId = :categoryId')->setParameter('categoryId', $categoryId->toString())
            ->getQuery()
            ->getResult();

        if (empty($productRows)) {
            throw ProductsNotFoundException::fromCategoryId($categoryId->toString());
        }

        return array_map(
            static function (array $row): ProductDTO {
                /** @var UuidInterface $id */
                $id = $row['id'];
                /** @var Money $price */
                $price = $row['price'];
                /** @var Name $name */
                $name = $row['name'];
                /** @var Description $description */
                $description = $row['description'];

                return new ProductDTO(
                    $id->toString(),
                    $name->name,
                    $description->description,
                    $price->getAmount(),
                    $price->getCurrency()->getCode(),
                );
            },
            $productRows
        );
    }
}
