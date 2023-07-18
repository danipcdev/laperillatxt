<?php

declare(strict_types=1);

namespace Txt\Application\UseCase\Txt\CreateTxt\DTO;

use Txt\Domain\Exception\InvalidArgumentException;
use Txt\Domain\Validation\Traits\AssertNotNullTrait;
use Type\Domain\Model\Type;

readonly class CreateTxtInputDTO
{
    use AssertNotNullTrait;

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
        $this->assertTitleLength($this->title);
    }

    public static function create(?string $title, ?string $text, ?Type $type): self
    {
        return new static($title, $text, $type);
    }

    private function assertTitleLength(string $title): void
    {
        if (\strlen($title) < 2 || \strlen($title) > 40) {
            throw InvalidArgumentException::createFromArgument('title');
        }
    }
}
