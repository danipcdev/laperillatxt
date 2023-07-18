<?php

declare(strict_types=1);

namespace App\Tests\Functional\Txt\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\AbstractBrowser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TxtControllerTestBase extends WebTestCase
{
    protected const CREATE_TXT_ENDPOINT = '/txt/create';
    protected const NON_EXISTING_TXT_ID = 'e0a1878f-dd52-4eea-959d-96f589a9f234';

    protected const CREATE_TYPE_ENDPOINT = '/type/create';

    protected static ?AbstractBrowser $client = null;

    public function setUp(): void
    {
        if (null === self::$client) {
            self::$client = static::createClient();
            self::$client->setServerParameter('CONTENT_TYPE', 'application/json');
        }
    }

    protected function getResponseData(Response $response): array
    {
        try {
            return \json_decode($response->getContent(), true);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    protected function createTxt(): string
    {
        $payload = [
            'title' => 'Txt de prueba',
            'text' => 'Texto del txt de prueba',
        ];

        self::$client->request(Request::METHOD_POST, self::CREATE_TXT_ENDPOINT, [], [], [], \json_encode($payload));

        $response = self::$client->getResponse();
        $responseData = $this->getResponseData($response);

        return $responseData['txtId'];
    }

    protected function createType(): string
    {
        $payload = [
            'name' => 'Microrrelato',
        ];

        self::$client->request(Request::METHOD_POST, self::CREATE_TYPE_ENDPOINT, [], [], [], \json_encode($payload));

        $response = self::$client->getResponse();
        $responseData = $this->getResponseData($response);

        return $responseData['typeId'];
    }
}