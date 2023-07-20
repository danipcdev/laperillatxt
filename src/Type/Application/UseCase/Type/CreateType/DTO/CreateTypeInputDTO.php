<?php

declare(strict_types=1);

namespace Type\Application\UseCase\Type\CreateType\DTO;

use Type\Domain\Model\Type;
use Type\Domain\Validation\Traits\AssertLengthRangeTrait;
use Type\Domain\Validation\Traits\AssertNotNullTrait;

readonly class CreateTypeInputDTO
{
    use AssertNotNullTrait;
    use AssertLengthRangeTrait;

    private const ARGS = [
        'name',
    ];

    private function __construct(
        public ?string $name,
    ) {
        $this->assertNotNull(self::ARGS, [$this->name]);
        $this->assertValueRangeLength($this->name, Type::NAME_MIN_LENGTH, Type::NAME_MAX_LENGTH);
    }

    public static function create(?string $name): self
    {
        return new static($name);
    }
}
