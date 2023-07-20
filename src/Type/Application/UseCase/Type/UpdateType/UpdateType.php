<?php

declare(strict_types=1);

namespace Type\Application\UseCase\Type\UpdateType;

use Type\Application\UseCase\Type\UpdateType\DTO\UpdateTypeInputDTO;
use Type\Application\UseCase\Type\UpdateType\DTO\UpdateTypeOutputDTO;
use Type\Domain\Model\Type;
use Type\Domain\Repository\TypeRepository;
use Type\Domain\ValueObject\Uuid;

readonly class UpdateType
{
    private const SETTER_PREFIX = 'set';

    public function __construct(
        private TypeRepository $typeRepository
    ) {
    }

    public function handle(UpdateTypeInputDTO $dto): UpdateTypeOutputDTO
    {
        $type = $this->typeRepository->findOneByIdOrFail($dto->id);

        foreach ($dto->paramsToUpdate as $param) {
            $type->{\sprintf('%s%s', self::SETTER_PREFIX, \ucfirst($param))}($dto->{$param});
        }

        $this->typeRepository->save($type);

        return UpdateTypeOutputDTO::createFromModel($type);
    }
}
