<?php

declare(strict_types=1);

namespace Type\Infrastructure\Controller\Type;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;
use Type\Application\UseCase\Type\UpdateType\UpdateType;
use Type\Application\UseCase\Type\UpdateType\DTO\UpdateTypeInputDTO;
use Type\Infrastructure\DTO\UpdateTypeRequestDTO;

class UpdateTypeController extends AbstractController
{
    public function __construct(
        private readonly UpdateType $service,
        private readonly SerializerInterface $serializer,
    ) {
    }

    public function __invoke(UpdateTypeRequestDTO $request): Response
    {
        $inputDTO = UpdateTypeInputDTO::create($request->id, $request->name, $request->keys);

        $responseDTO = $this->service->handle($inputDTO);

        return new JsonResponse(
            $this->serializer->serialize($responseDTO, 'json', ['groups' => ['api']]), json: true
        );
    }
}
