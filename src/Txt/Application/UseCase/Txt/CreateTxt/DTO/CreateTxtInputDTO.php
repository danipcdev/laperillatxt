<?php

declare(strict_types=1);

namespace Txt\Application\UseCase\Txt\CreateTxt\DTO;

use Txt\Domain\Exception\InvalidArgumentException;
use Txt\Domain\Validation\Traits\AssertNotNullTrait;

readonly class CreateTxtInputDTO
{
    use AssertNotNullTrait;

    private const ARGS = [
        'title',
        'text',
    ];

    private function __construct(
        public ?string $title,
        public ?string $text,
    ) {
        $this->assertNotNull(self::ARGS, [$this->title, $this->text]);
        $this->assertTitleLength($this->title);
    }

    public static function create(?string $title, ?string $text): self
    {
        return new static($title, $text);
    }

    private function assertTitleLength(string $title): void
    {
        if (\strlen($title) < 2 || \strlen($title) > 40) {
            throw InvalidArgumentException::createFromArgument('title');
        }
    }
}
