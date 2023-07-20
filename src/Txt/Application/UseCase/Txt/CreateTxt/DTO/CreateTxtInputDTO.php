<?php

declare(strict_types=1);

namespace Txt\Application\UseCase\Txt\CreateTxt\DTO;

use Txt\Domain\Model\Txt;
use Txt\Domain\Validation\Traits\AssertLengthRangeTrait;
use Txt\Domain\Validation\Traits\AssertNotNullTrait;
use Type\Domain\Model\Type;

readonly class CreateTxtInputDTO
{
    use AssertNotNullTrait;
    use AssertLengthRangeTrait;

    private const ARGS = [
        'title',
        'text',
        'type',
    ];

    private function __construct(
        public ?string $title,
        public ?string $text,
        public ?Type $type,
    ) {
        $this->assertNotNull(self::ARGS, [$this->title, $this->text, $this->type]);
        $this->assertValueRangeLength($this->title, Txt::TITLE_MIN_LENGTH, Txt::TITLE_MAX_LENGTH);
    }

    public static function create(?string $title, ?string $text, ?Type $type): self
    {
        return new static($title, $text, $type);
    }
}
