<?php declare(strict_types=1);

namespace App\Tests\Feature\UI\Http;

use App\Tests\Unit\Util\GreetingDataProvider;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class GreetingAdapterTest extends WebTestCase
{
    /**
     * @test
     * @dataProvider namesDataProvider
     */
    public function shouldSayHello(string $name): void
    {
        $client = static::createClient();
        $client->request('GET', sprintf('/greetings?name=%s', $name));
        $response = $client->getResponse();

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertJsonStringEqualsJsonString(
            GreetingDataProvider::createResponseJson($name),
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
