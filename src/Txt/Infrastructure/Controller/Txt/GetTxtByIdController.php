<?php

declare(strict_types=1);

namespace Txt\Infrastructure\Controller\Txt;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Txt\Application\UseCase\Txt\GetTxtById\DTO\GetTxtByIdInputDTO;
use Txt\Application\UseCase\Txt\GetTxtById\GetTxtById;
use Txt\Infrastructure\DTO\GetTxtByIdRequestDTO;

readonly class GetTxtByIdController
{
    public function __construct(
        private GetTxtById $useCase,
        private SerializerInterface $serializer
    ) {
    }

    public function __invoke(GetTxtByIdRequestDTO $request): Response
    {
        $responseDTO = $this->useCase->handle(GetTxtByIdInputDTO::create($request->id));

        return new JsonResponse(
            $this->serializer->serialize($responseDTO, 'json', ['groups' => ['api']]), json: true
        );
    }
}
