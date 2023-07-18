<?php

declare(strict_types=1);

namespace Type\Infrastructure\Controller\Type;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Type\Application\UseCase\Type\DeleteType\DeleteType;
use Type\Application\UseCase\Type\DeleteType\DTO\DeleteTypeInputDTO;
use Type\Infrastructure\DTO\DeleteTypeRequestDTO;

readonly class DeleteTypeController
{
    public function __construct(private DeleteType $useCase)
    {
    }

    public function __invoke(DeleteTypeRequestDTO $request): Response
    {
        $this->useCase->handle(DeleteTypeInputDTO::create($request->id));

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
