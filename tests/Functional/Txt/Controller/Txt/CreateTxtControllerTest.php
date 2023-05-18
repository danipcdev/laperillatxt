<?php

declare(strict_types=1);

namespace App\Tests\Functional\Txt\Controller\Txt;

use App\Tests\Functional\Txt\Controller\TxtControllerTestBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateTxtControllerTest extends TxtControllerTestBase
{
    private const ENDPOINT = '/txt/create';

    public function testCreateTxtAndCheckIt(): void
    {
        $payload = [
            'title' => 'Prueba desde test',
            'text' => 'Prueba desde test',
        ];

        self::$client->request(Request::METHOD_POST, self::ENDPOINT, [], [], [], \json_encode($payload));

        $response = self::$client->getResponse();
        $responseData = $this->getResponseData($response);

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        self::assertArrayHasKey('txtId', $responseData);
        self::assertEquals(36, \strlen($responseData['txtId']));
    }
}