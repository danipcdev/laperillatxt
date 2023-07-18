<?php

declare(strict_types=1);

namespace Type\Application\UseCase\Type\DeleteType;

use Type\Application\UseCase\Type\DeleteType\DTO\DeleteTypeInputDTO;
use Type\Domain\Repository\TypeRepository;

readonly class DeleteType
{
    public function __construct(private TypeRepository $repository)
    {
    }

    public function handle(DeleteTypeInputDTO $dto): void
    {
        $type = $this->repository->findOneByIdOrFail($dto->id);

        $this->repository->remove($type);
    }
}
