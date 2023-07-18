<?php

declare(strict_types=1);

namespace Type\Application\UseCase\Type\CreateType\DTO;

readonly class CreateTypeOutputDTO
{
    public function __construct(public string $id)
    {
    }
}
