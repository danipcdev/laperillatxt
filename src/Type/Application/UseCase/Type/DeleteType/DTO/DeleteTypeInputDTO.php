<?php

declare(strict_types=1);

namespace Type\Application\UseCase\Type\DeleteType\DTO;

use Type\Domain\Validation\Traits\AssertNotNullTrait;

readonly class DeleteTypeInputDTO
{
    use AssertNotNullTrait;

    private const ARGS = [
        'id',
    ];

    private function __construct(
        public ?string $id,
    ) {
        $this->assertNotNull(self::ARGS, [$this->id]);
    }

    public static function create(?string $id): self
    {
        return new static($id);
    }
}
