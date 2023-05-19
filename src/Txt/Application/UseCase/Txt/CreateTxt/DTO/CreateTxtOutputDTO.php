<?php

declare(strict_types=1);

namespace Txt\Application\UseCase\Txt\CreateTxt\DTO;

readonly class CreateTxtOutputDTO
{
    public function __construct(public string $id)
    {
    }
}
