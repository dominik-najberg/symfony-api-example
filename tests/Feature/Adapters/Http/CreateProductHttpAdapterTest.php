<?php declare(strict_types=1);

namespace App\Tests\Feature\Adapters\Http;

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
        $this->manager = self::$container->get('doctrine')->getManager();
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
        $id           = Uuid::uuid4()->toString();
        $productName  = 'Product name';
        $description  = str_repeat('Simple description that is at least 100 chars long... ', 2);
        $amount       = 1000;
        $currency     = 'PLN';
        $expectedJson = $this->makeJsonApiReply($id, $productName, $description, $amount, $currency);

        $this->client->request('POST', '/products', [
            'id'          => $id,
            'name'        => $productName,
            'description' => $description,
            'amount'      => $amount,
            'currency'    => $currency,
        ]);
        $response = $this->client->getResponse();

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());

        self::assertJsonStringEqualsJsonString($expectedJson, $response->getContent());

        /** @var Product $actual */
        $actual = $this->manager->find(Product::class, $id);

        self::assertEquals($productName, $actual->name()->name());
        self::assertEquals($description, $actual->description()->description());
        self::assertEquals($amount, (int)$actual->price()->getAmount());
        self::assertEquals($currency, $actual->price()->getCurrency()->getCode());
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
