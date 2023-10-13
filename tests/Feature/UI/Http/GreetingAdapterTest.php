<?php declare(strict_types=1);

namespace App\Tests\Feature\UI\Http;

use App\Tests\Util\DataProvider\GreetingDataProvider;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class GreetingAdapterTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();
    }

    /**
     * @dataProvider namesDataProvider
     */
    public function test_should_say_hello(string $name): void
    {
        $this->client->request('GET', sprintf('/greetings?name=%s', $name));
        $response = $this->client->getResponse();

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertJsonStringEqualsJsonString(
            GreetingDataProvider::createResponseJson($name),
            $response->getContent()
        );
    }

    public static function namesDataProvider(): array
    {
        return [
            ['Dominik'],
            ['Pawel'],
            ['Anna'],
            ['Leon'],
        ];
    }
}
