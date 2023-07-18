<?php

declare(strict_types=1);

namespace Type\Application\UseCase\Type\CreateType;

use Type\Application\UseCase\Type\CreateType\DTO\CreateTypeInputDTO;
use Type\Application\UseCase\Type\CreateType\DTO\CreateTypeOutputDTO;
use Type\Domain\Model\Type;
use Type\Domain\Repository\TypeRepository;
use Type\Domain\ValueObject\Uuid;

readonly class CreateType
{
    public function __construct(private TypeRepository $repository)
    {
    }

    public function handle(CreateTypeInputDTO $dto): CreateTypeOutputDTO
    {
        $type = Type::create(Uuid::random()->value(), $dto->name);

        $this->repository->save($type);

        return new CreateTypeOutputDTO($type->id());
    }
}
