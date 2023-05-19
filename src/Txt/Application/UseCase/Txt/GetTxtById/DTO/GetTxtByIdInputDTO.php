<?php

declare(strict_types=1);

namespace Txt\Application\UseCase\Txt\GetTxtById\DTO;

use Txt\Domain\Exception\InvalidArgumentException;

readonly class GetTxtByIdInputDTO
{
    private function __construct(
        public string $id
    ) {
    }

    public static function create(?string $id): self
    {
        if (\is_null($id)) {
            throw InvalidArgumentException::createFromArgument('id');
        }

        return new static($id);
    }
}
