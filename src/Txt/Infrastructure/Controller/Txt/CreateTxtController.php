<?php

declare(strict_types=1);

namespace Txt\Infrastructure\Controller\Txt;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Txt\Application\UseCase\Txt\CreateTxt\CreateTxt;
use Txt\Application\UseCase\Txt\CreateTxt\DTO\CreateTxtInputDTO;
use Txt\Domain\Exception\TxtAlreadyExistsException;
use Txt\Infrastructure\DTO\CreateTxtRequestDTO;
use Type\Domain\Repository\TypeRepository;

readonly class CreateTxtController
{
    public function __construct(private CreateTxt $service, private TypeRepository $typeRepository)
    {
    }

    public function __invoke(CreateTxtRequestDTO $request): Response
    {
        $typeId = $request->typeId;
        if($request->typeId === null) $typeId = '';

        $type = $this->typeRepository->findOneByIdOrFail($typeId);
        try {
            $responseDTO = $this->service->handle(CreateTxtInputDTO::create($request->title, $request->text, $type));
        } catch (TxtAlreadyExistsException $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_CONFLICT);
        }
        return new JsonResponse(['txtId' => $responseDTO->id], Response::HTTP_CREATED);
    }
}
