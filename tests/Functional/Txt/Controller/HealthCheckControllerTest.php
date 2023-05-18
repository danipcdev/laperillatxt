<?php

declare(strict_types=1);

namespace App\Tests\Functional\Txt\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HealthCheckControllerTest extends TxtControllerTestBase
{
    private const ENDPOINT = '/txt/health-check';

    public function testTxtHealthCheck(): void
    {
        self::$client->request(Request::METHOD_GET, self::ENDPOINT);

        $response = self::$client->getResponse();
        $responseData = $this->getResponseData($response);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertEquals('Txt Controller Up and running!', $responseData['message']);
    }
}