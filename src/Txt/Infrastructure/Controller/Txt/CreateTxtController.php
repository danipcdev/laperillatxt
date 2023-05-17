<?php

declare(strict_types=1);

namespace Txt\Infrastructure\Controller\Txt;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Txt\Application\CreateTxt\CreateTxt;
use Txt\Application\CreateTxt\DTO\CreateTxtInputDTO;

readonly class CreateTxtController
{
    public function __construct(private CreateTxt $service)
    {
    }

    public function __invoke(Request $request): Response
    {
        $data = \json_decode($request->getContent(), true);

        $responseDTO = $this->service->__invoke(CreateTxtInputDTO::create($data['title'], $data['text']));

        return new JsonResponse(['txtId' => $responseDTO->id], Response::HTTP_CREATED);
    }
}
