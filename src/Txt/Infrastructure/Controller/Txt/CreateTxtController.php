<?php

declare(strict_types=1);

namespace Txt\Infrastructure\Controller\Txt;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Txt\Application\CreateTxt\CreateTxt;
use Txt\Application\CreateTxt\DTO\CreateTxtInputDTO;
use Txt\Infrastructure\DTO\CreateTxtRequestDTO;

readonly class CreateTxtController
{
    public function __construct(private CreateTxt $service)
    {
    }

    public function __invoke(CreateTxtRequestDTO $request): Response
    {
        $responseDTO = $this->service->__invoke(CreateTxtInputDTO::create($request->title, $request->text));

        return new JsonResponse(['txtId' => $responseDTO->id], Response::HTTP_CREATED);
    }
}
