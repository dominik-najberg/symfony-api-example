<?php

namespace App\Tests\Util\Seeder;

use App\Tests\Util\DataProvider\ProductDataProvider;
use Doctrine\Persistence\ObjectManager;

class ProductSeeder implements Seeder
{
    public function load(ObjectManager $manager)
    {
        $products = ProductDataProvider::products();

        foreach ($products as $product) {
            $manager->persist($product);
        }

        $manager->flush();
    }
}
