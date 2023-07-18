<?php

declare(strict_types=1);

namespace Txt\Application\UseCase\Txt\GetTxtById\DTO;

use Txt\Domain\Model\Txt;
use Type\Domain\Model\Type;

readonly class GetTxtByIdOutputDTO
{
    private function __construct(
        public string $id,
        public string $title,
        public string $text,
        public Type $type,
    ) {
    }

    public static function create(Txt $txt): self
    {
        return new self(
            $txt->id(),
            $txt->title(),
            $txt->text(),
            $txt->type(),
        );
    }
}
