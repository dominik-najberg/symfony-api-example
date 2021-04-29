<?php declare(strict_types=1);

namespace App\Tests\Util\DataProvider;

class GreetingDataProvider
{
    public static function createResponseJson(string $name): string
    {
        return sprintf(
            '{"data":{"type":"greetings","id":"UUID","attributes":{"greeting":"Hello, %s!"}}}',
            $name
        );
    }
}
