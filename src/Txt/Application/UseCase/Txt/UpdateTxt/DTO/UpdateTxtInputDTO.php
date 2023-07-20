<?php

declare(strict_types=1);

namespace Txt\Application\UseCase\Txt\UpdateTxt\DTO;

use Txt\Domain\Validation\Traits\AssertLengthRangeTrait;
use Txt\Domain\Model\Txt;
use Txt\Domain\Validation\Traits\AssertNotNullTrait;
use Type\Domain\Model\Type;

readonly class UpdateTxtInputDTO
{
    use AssertLengthRangeTrait;
    use AssertNotNullTrait;

    private const ARGS = ['id'];

    private function __construct(
        public ?string $id,
        public ?string $title,
        public ?string $text,
        public ?Type $type,
        public array $paramsToUpdate,
    ) {
        $this->assertNotNull(self::ARGS, [$this->id]);

        if (!\is_null($this->title)) {
            $this->assertValueRangeLength($this->title, Txt::TITLE_MIN_LENGTH, Txt::TITLE_MAX_LENGTH);
        }
    }

    public static function create(?string $id, ?string $title, ?string $text, ?Type $type, array $paramsToUpdate): self
    {
        return new static($id, $title, $text, $type, $paramsToUpdate);
    }
}
