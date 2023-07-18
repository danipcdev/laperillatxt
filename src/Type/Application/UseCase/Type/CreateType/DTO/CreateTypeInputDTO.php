<?php

declare(strict_types=1);

namespace Type\Application\UseCase\Type\CreateType\DTO;

use Type\Domain\Exception\InvalidArgumentException;
use Type\Domain\Validation\Traits\AssertNotNullTrait;

readonly class CreateTypeInputDTO
{
    use AssertNotNullTrait;

    private const ARGS = [
        'name',
    ];

    private function __construct(
        public ?string $name,
    ) {
        $this->assertNotNull(self::ARGS, [$this->name]);
        $this->assertNameLength($this->name);
    }

    public static function create(?string $name): self
    {
        return new static($name);
    }

    private function assertNameLength(string $name): void
    {
        if (\strlen($name) < 2 || \strlen($name) > 30) {
            throw InvalidArgumentException::createFromArgument('name');
        }
    }
}
