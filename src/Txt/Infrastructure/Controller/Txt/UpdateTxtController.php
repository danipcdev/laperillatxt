<?php

declare(strict_types=1);

namespace Txt\Infrastructure\Controller\Txt;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;
use Txt\Application\UseCase\Txt\UpdateTxt\UpdateTxt;
use Txt\Application\UseCase\Txt\UpdateTxt\DTO\UpdateTxtInputDTO;
use Txt\Infrastructure\DTO\UpdateTxtRequestDTO;
use Type\Domain\Repository\TypeRepository;

class UpdateTxtController extends AbstractController
{
    public function __construct(
        private readonly UpdateTxt $service,
        private readonly TypeRepository $typeRepository,
        private readonly SerializerInterface $serializer,
    ) {
    }

    public function __invoke(UpdateTxtRequestDTO $request): Response
    {
        $type = $this->typeRepository->findOneByIdOrFail($request->typeId);

        $inputDTO = UpdateTxtInputDTO::create($request->id, $request->title, $request->text, $type, $request->keys);

        $responseDTO = $this->service->handle($inputDTO);

        return new JsonResponse(
            $this->serializer->serialize($responseDTO, 'json', ['groups' => ['api']]), json: true
        );
    }
}
