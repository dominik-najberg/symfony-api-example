<?php

namespace App\Infrastructure\DataFixtures;

use App\Domain\Product\Description;
use App\Domain\Product\Name;
use App\Domain\Product\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Money\Money;
use Ramsey\Uuid\Uuid;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $products = $this->productsDataProvider();

        foreach ($products as $product) {
            $manager->persist($product);
        }

        $manager->flush();
    }

    private function productsDataProvider(): \Iterator
    {
        for ($i = 0; $i < 20; $i++) {
            yield new Product(
                Uuid::uuid4(),
                new Name(sprintf('Product name #%02d', $i)),
                new Description(str_repeat(sprintf('Description %02d ', $i), 20)),
                Money::USD($i * 100)
            );
        }
    }
}
