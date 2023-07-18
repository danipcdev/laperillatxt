<?php

declare(strict_types=1);

namespace App\Tests\Functional\Type\Controller\Type;

use App\Tests\Functional\Type\Controller\TypeControllerTestBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateTypeControllerTest extends TypeControllerTestBase
{
    private const ENDPOINT = '/type/create';

    public function testCreateTypeAndCheckIt(): void
    {
        $payload = [
            'name' => 'Microrrelato',
        ];

        self::$client->request(Request::METHOD_POST, self::ENDPOINT, [], [], [], \json_encode($payload));

        $response = self::$client->getResponse();
        $responseData = $this->getResponseData($response);

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        self::assertArrayHasKey('typeId', $responseData);
        self::assertEquals(36, \strlen($responseData['typeId']));

        $generatedTypeId = $responseData['typeId'];

        self::$client->request(Request::METHOD_GET, \sprintf('/type/%s', $generatedTypeId ));

        $response = self::$client->getResponse();
        $responseData = $this->getResponseData($response);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());

        self::assertArrayHasKey('id', $responseData);
        self::assertArrayHasKey('name', $responseData);

        self::assertEquals($generatedTypeId, $responseData['id']);
        self::assertEquals($payload['name'], $responseData['name']);
    }
}