<?php

declare(strict_types=1);

namespace Type\Application\UseCase\Type\GetTypeById\DTO;

use Type\Domain\Validation\Traits\AssertNotNullTrait;

readonly class GetTypeByIdInputDTO
{
    use AssertNotNullTrait;

    private const ARGS = ['id'];

    private function __construct(
        public ?string $id
    ) {
        $this->assertNotNull(self::ARGS, [$this->id]);
    }

    public static function create(?string $id): self
    {
        return new static($id);
    }
}
