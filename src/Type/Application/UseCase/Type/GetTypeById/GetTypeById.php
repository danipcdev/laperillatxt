<?php

declare(strict_types=1);

namespace Type\Application\UseCase\Type\GetTypeById;

use Type\Application\UseCase\Type\GetTypeById\DTO\GetTypeByIdInputDTO;
use Type\Application\UseCase\Type\GetTypeById\DTO\GetTypeByIdOutputDTO;
use Type\Domain\Repository\TypeRepository;

readonly class GetTypeById
{
    public function __construct(
        private TypeRepository $typeRepository
    ) {
    }

    public function handle(GetTypeByIdInputDTO $dto): GetTypeByIdOutputDTO
    {
        return GetTypeByIdOutputDTO::create($this->typeRepository->findOneByIdOrFail($dto->id));
    }
}
