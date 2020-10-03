<?php declare(strict_types=1);

namespace App\Tests\Feature\Adapters;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class HelloWorldAdapterTest extends WebTestCase
{
    /**
     * @test
     */
    public function shouldSayHello(): void
    {
        $client = static::createClient();
        $client->request('GET', '/hello-world?name=Dominik');
        $response = $client->getResponse();

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertEquals('Hello, Dominik!', $response->getContent());
    }
}
