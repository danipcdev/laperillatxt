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
            'typeId' => '2ac51729-8e25-4021-85af-437282ed46f5',
        ];

        $json = \json_encode($payload);

        self::$client->request(Request::METHOD_POST, self::ENDPOINT, [], [], [], $json);

        $response = self::$client->getResponse();
        $responseData = $this->getResponseData($response);

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        self::assertArrayHasKey('txtId', $responseData);
        self::assertEquals(36, \strlen($responseData['txtId']));

        $generatedTxtId = $responseData['txtId'];

        self::$client->request(Request::METHOD_GET, \sprintf('/txt/%s', $generatedTxtId ));

        $response = self::$client->getResponse();
        $responseData = $this->getResponseData($response);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());

        self::assertArrayHasKey('id', $responseData);
        self::assertArrayHasKey('title', $responseData);
        self::assertArrayHasKey('text', $responseData);

        self::assertEquals($generatedTxtId, $responseData['id']);
        self::assertEquals($payload['title'], $responseData['title']);
        self::assertEquals($payload['text'], $responseData['text']);
    }
}