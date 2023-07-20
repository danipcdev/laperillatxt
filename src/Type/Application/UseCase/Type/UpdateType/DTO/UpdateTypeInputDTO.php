<?php

declare(strict_types=1);

namespace Type\Application\UseCase\Type\UpdateType\DTO;

use Type\Domain\Validation\Traits\AssertLengthRangeTrait;
use Type\Domain\Model\Type;
use Type\Domain\Validation\Traits\AssertNotNullTrait;

readonly class UpdateTypeInputDTO
{
    use AssertLengthRangeTrait;
    use AssertNotNullTrait;

    private const ARGS = ['id'];

    private function __construct(
        public ?string $id,
        public ?string $name,
        public array $paramsToUpdate,
    ) {
        $this->assertNotNull(self::ARGS, [$this->id]);

        if (!\is_null($this->name)) {
            $this->assertValueRangeLength($this->name, Type::NAME_MIN_LENGTH, Type::NAME_MAX_LENGTH);
        }
    }

    public static function create(?string $id, ?string $name, array $paramsToUpdate): self
    {
        return new static($id, $name, $paramsToUpdate);
    }
}
