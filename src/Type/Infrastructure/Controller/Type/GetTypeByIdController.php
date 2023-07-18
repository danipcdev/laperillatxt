<?php

declare(strict_types=1);

namespace Type\Infrastructure\Controller\Type;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Type\Application\UseCase\Type\GetTypeById\DTO\GetTypeByIdInputDTO;
use Type\Application\UseCase\Type\GetTypeById\GetTypeById;
use Type\Infrastructure\DTO\GetTypeByIdRequestDTO;

readonly class GetTypeByIdController
{
    public function __construct(
        private GetTypeById $useCase
    ) {
    }

    public function __invoke(GetTypeByIdRequestDTO $request): Response
    {
        $responseDTO = $this->useCase->handle(GetTypeByIdInputDTO::create($request->id));

        return new JsonResponse($responseDTO);
    }
}
