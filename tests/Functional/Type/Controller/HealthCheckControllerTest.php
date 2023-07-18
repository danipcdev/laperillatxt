<?php

declare(strict_types=1);

namespace App\Tests\Functional\Type\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HealthCheckControllerTest extends TypeControllerTestBase
{
    private const ENDPOINT = '/type/health-check';

    public function testTypeHealthCheck(): void
    {
        self::$client->request(Request::METHOD_GET, self::ENDPOINT);

        $response = self::$client->getResponse();
        $responseData = $this->getResponseData($response);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertEquals('Type Controller Up and running!', $responseData['message']);
    }
}