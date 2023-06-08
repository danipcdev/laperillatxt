<?php

declare(strict_types=1);

namespace App\Tests\Functional\Txt\Controller\Txt;

use App\Tests\Functional\Txt\Controller\TxtControllerTestBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DeleteTxtControllerTest extends TxtControllerTestBase
{
    private const ENDPOINT = '/txt/%s';

    public function testDeleteTxt(): void
    {
        $txtId = $this->createTxt();

        self::$client->request(Request::METHOD_DELETE, \sprintf(self::ENDPOINT, $txtId));

        $response = self::$client->getResponse();

        self::assertEquals(Response::HTTP_NO_CONTENT, $response->getStatusCode());
    }

    public function testDeleteNonExistingTxt(): void
    {
        self::$client->request(Request::METHOD_DELETE, \sprintf(self::ENDPOINT, self::NON_EXISTING_TXT_ID));

        $response = self::$client->getResponse();

        self::assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
    }
}