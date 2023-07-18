<?php

declare(strict_types=1);

namespace Type\Infrastructure\Controller\Type;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Type\Application\UseCase\Type\CreateType\CreateType;
use Type\Application\UseCase\Type\CreateType\DTO\CreateTypeInputDTO;
use Type\Infrastructure\DTO\CreateTypeRequestDTO;

readonly class CreateTypeController
{
    public function __construct(private CreateType $service)
    {
    }

    public function __invoke(CreateTypeRequestDTO $request): Response
    {
        $responseDTO = $this->service->handle(CreateTypeInputDTO::create($request->name));

        return new JsonResponse(['typeId' => $responseDTO->id], Response::HTTP_CREATED);
    }
}
