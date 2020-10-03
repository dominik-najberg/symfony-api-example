<?php declare(strict_types=1);

namespace App\Tests\Feature\Adapters;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class HelloWorldAdapterTest extends WebTestCase
{
    /**
     * @test
     * @dataProvider namesDataProvider
     */
    public function shouldSayHello(string $name): void
    {
        $client = static::createClient();
        $client->request('GET', sprintf('/hello-world?name=%s', $name));
        $response = $client->getResponse();

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertJsonStringEqualsJsonString(
            sprintf('{"data":{"type":"hello-worlds","id":"UUID","attributes":{"greeting":"Hello, %s!"}}}', $name),
            $response->getContent()
        );
    }

    public function namesDataProvider(): array
    {
        return [
            ['Dominik'],
            ['Pawel'],
            ['Anna'],
            ['Leon'],
        ];
    }
}
