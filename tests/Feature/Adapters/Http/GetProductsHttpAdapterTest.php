<?php declare(strict_types=1);

namespace App\Tests\Feature\Adapters\Http;

use App\Tests\Util\DataProvider\ProductDataProvider;
use App\Tests\Util\Seeder\DbSeeder;
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
        $entityManager = self::$container->get('doctrine')->getManager();
        (new DbSeeder($entityManager))->load(ProductDataProvider::singleProduct());
    }

    /**
     * @test
     */
    public function shouldGetHttpOkResponse(): void
    {
        $this->markTestSkipped('we need behat');

        $this->client->request('GET', sprintf('/products'));
        $response = $this->client->getResponse();

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    /**
     * @test
     */
    public function shouldGetProductsInResponse(): void
    {
        $this->markTestSkipped('we need behat');
        $this->client->request('GET', sprintf('/products'));
        $response = $this->client->getResponse();

        $content = $response->getContent();
        self::assertJson($content);
    }
}