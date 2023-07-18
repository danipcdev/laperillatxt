<?php

declare(strict_types=1);

namespace Type\Application\UseCase\Type\GetTypeById\DTO;

use Type\Domain\Model\Type;

readonly class GetTypeByIdOutputDTO
{
    private function __construct(
        public string $id,
        public string $name,
    ) {
    }

    public static function create(Type $type): self
    {
        return new self(
            $type->id(),
            $type->name(),
        );
    }
}
