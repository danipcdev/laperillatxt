<?php

declare(strict_types=1);

namespace App\Tests\Functional\Type\Controller\Type;

use App\Tests\Functional\Type\Controller\TypeControllerTestBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DeleteTypeControllerTest extends TypeControllerTestBase
{
    private const ENDPOINT = '/type/%s';

    public function testDeleteType(): void
    {
        $typeId = $this->createType();

        self::$client->request(Request::METHOD_DELETE, \sprintf(self::ENDPOINT, $typeId));

        $response = self::$client->getResponse();

        self::assertEquals(Response::HTTP_NO_CONTENT, $response->getStatusCode());
    }

    public function testDeleteNonExistingType(): void
    {
        self::$client->request(Request::METHOD_DELETE, \sprintf(self::ENDPOINT, self::NON_EXISTING_TXT_ID));

        $response = self::$client->getResponse();

        self::assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
    }
}