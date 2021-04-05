<?php declare(strict_types=1);

namespace App\Tests\Feature\Adapters\Http;

use App\Domain\Product\Product;
use App\Tests\Util\DataProvider\ProductDataProvider;
use App\Tests\Util\Seeder\DbSeeder;
use App\Tests\Util\Seeder\DbTableTruncator;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PostProductHttpAdapterTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client  = static::createClient();
        $entityManager = self::$container->get('doctrine')->getManager();
        (new DbTableTruncator($entityManager))->truncate(Product::class);
        (new DbSeeder($entityManager))->load(ProductDataProvider::singleProduct());
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
        $this->client->request('POST', '/products', [
            'id'          => Uuid::uuid4()->toString(),
            'name'        => 'Product name',
            'description' => 'Simple description',
            'amount'      => 1000,
            'currency'    => 'PLN',
        ]);
        $response = $this->client->getResponse();

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
    }
}
