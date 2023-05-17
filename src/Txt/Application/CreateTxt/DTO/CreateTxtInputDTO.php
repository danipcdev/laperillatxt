<?php

declare(strict_types=1);

namespace Txt\Application\CreateTxt\DTO;

readonly class CreateTxtInputDTO
{
    private function __construct(
        public string $title,
        public string $text,
    ) {
    }

    public static function create(string $title, string $text): self
    {
        return new self($title, $text);
    }
}
