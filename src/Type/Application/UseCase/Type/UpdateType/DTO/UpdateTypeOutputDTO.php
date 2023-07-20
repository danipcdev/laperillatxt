<?php

declare(strict_types=1);

namespace Type\Application\UseCase\Type\UpdateType\DTO;

use Type\Domain\Model\Type;

readonly class UpdateTypeOutputDTO
{
    private function __construct(
        public string $id,
        public string $name,
    ) {
    }

    public static function createFromModel(Type $type): self
    {
        return new self(
            $type->id(),
            $type->name(),
        );
    }
}
