<?php declare(strict_types=1);

namespace App\Tests\Feature\UI\Http;

use App\Domain\Product\Product;
use App\Tests\Util\DataProvider\ProductDataProvider;
use App\Tests\Util\Seeder\DbSeeder;
use App\Tests\Util\Seeder\DbTableTruncator;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class GetProductsHttpAdapterTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client  = static::createClient();
        $entityManager = static::getContainer()->get('doctrine')->getManager();
        (new DbTableTruncator($entityManager))->truncate(Product::class);
        (new DbSeeder($entityManager))->load(ProductDataProvider::singleProduct());
    }

    /**
     * @test
     */
    public function shouldGetHttpOkResponse(): void
    {
        $this->client->request('GET', sprintf(sprintf('/products?category_id=%s', ProductDataProvider::CATEGORY_ID)));
        $response = $this->client->getResponse();

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function shouldGetProductsInResponse(): void
    {
        $this->client->request('GET', sprintf(sprintf('/products?category_id=%s', ProductDataProvider::CATEGORY_ID)));
        $response = $this->client->getResponse();

        $content = $response->getContent();
        self::assertJson($content);
        self::assertJsonStringEqualsJsonString($this->getValidJsonReply(), $content);
    }

    /**
     * @return string
     */
    private function getValidJsonReply(): string
    {
        return <<<JSON
{
  "data": [
    {
      "type": "products",
      "id": "82e00d1b-b8a9-4011-a5aa-a5e92c3e2021",
      "attributes": {
        "title": "One interesting product",
        "description": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet",
        "price": "1000 GBP"
      }
    }
  ]
}
JSON;
    }
}
