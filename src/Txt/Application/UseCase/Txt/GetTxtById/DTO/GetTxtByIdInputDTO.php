<?php

declare(strict_types=1);

namespace Txt\Application\UseCase\Txt\GetTxtById\DTO;

use Txt\Domain\Validation\Traits\AssertNotNullTrait;

readonly class GetTxtByIdInputDTO
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
