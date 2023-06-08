<?php

declare(strict_types=1);

namespace Txt\Infrastructure\Controller\Txt;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Txt\Application\UseCase\Txt\DeleteTxt\DeleteTxt;
use Txt\Application\UseCase\Txt\DeleteTxt\DTO\DeleteTxtInputDTO;
use Txt\Infrastructure\DTO\DeleteTxtRequestDTO;

readonly class DeleteTxtController
{
    public function __construct(private DeleteTxt $useCase)
    {
    }

    public function __invoke(DeleteTxtRequestDTO $request): Response
    {
        $this->useCase->handle(DeleteTxtInputDTO::create($request->id));

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
