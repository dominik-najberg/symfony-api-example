<?php declare(strict_types=1);

namespace App\Tests\Feature\UI\Http;

use App\Domain\Product\Product;
use App\Tests\Util\DataProvider\ProductDataProvider;
use App\Tests\Util\Seeder\DbSeeder;
use App\Tests\Util\Seeder\DbTableTruncator;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CreateProductHttpAdapterTest extends WebTestCase
{
    private KernelBrowser          $client;
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client  = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        (new DbTableTruncator($this->manager))->truncate(Product::class);
        (new DbSeeder($this->manager))->load(ProductDataProvider::singleProduct());
    }

    /**
     * @test
     */
    public function shouldGetBadRequest(): void
    {
        $this->client->request('POST', '/products');
        $response = $this->client->getResponse();

        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function shouldGetHttpCreatedResponse(): void
    {
        $id = Uuid::uuid4()->toString();
        $categoryId = Uuid::uuid4()->toString();
        $productName = 'Product name';
        $description = str_repeat('Simple description that is at least 100 chars long... ', 2);
        $amount = 1000;
        $currency = 'PLN';
        $expectedJson = $this->makeJsonApiReply($id, $productName, $description, $amount, $currency);

        $this->client->request(
            'POST',
            '/products',
            [
                'id' => $id,
                'categoryId' => $categoryId,
                'name' => $productName,
                'description' => $description,
                'amount' => $amount,
                'currency' => $currency,
            ]
        );
        $response = $this->client->getResponse();

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());

        self::assertJsonStringEqualsJsonString($expectedJson, $response->getContent());

        /** @var Product $actual */
        $actual = $this->manager->find(Product::class, $id);

        $reflection = new \ReflectionObject($actual);

        self::assertEquals($productName, $reflection->getProperty('name')->getValue($actual)->name);
        self::assertEquals($description, $reflection->getProperty('description')->getValue($actual)->description);
        self::assertEquals($amount, (int)$reflection->getProperty('price')->getValue($actual)->getAmount());
        self::assertEquals($currency, $reflection->getProperty('price')->getValue($actual)->getCurrency()->getCode());
    }

    private function makeJsonApiReply(string $id, string $productName, string $description, int $amount, string $currency): string
    {
        return sprintf(
            '{
                "data": {
                    "type": "products",
                    "id": "%s",
                    "attributes": {
                        "name": "%s",
                        "description": "%s",
                        "amount": %d,
                        "currency": "%s"
                    }
                }
            }',
            $id,
            $productName,
            $description,
            $amount,
            $currency
        );
    }
}
