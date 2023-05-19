<?php

declare(strict_types=1);

namespace Txt\Application\UseCase\Txt\CreateTxt\DTO;

use Txt\Domain\Exception\InvalidArgumentException;

readonly class CreateTxtInputDTO
{
    private const         VALUES = [
        'title',
        'text',
    ];

    private function __construct(
        public string $title,
        public string $text,
    ) {
    }

    public static function create(?string $title, ?string $text): self
    {
        static::validateFields(\func_get_args());
        static::validateTitleLength($title);

        return new static($title, $text);
    }

    private static function validateFields(array $fields): void
    {
        $values = \array_combine(self::VALUES, $fields);

        $emptyValues = [];
        foreach ($values as $key => $value) {
            if (\is_null($value)) {
                $emptyValues[] = $key;
            }
        }

        if (!empty($emptyValues)) {
            throw InvalidArgumentException::createFromArray($emptyValues);
        }
    }

    private static function validateTitleLength(string $title): void
    {
        if (\strlen($title) < 2 || \strlen($title) > 40) {
            throw InvalidArgumentException::createFromArgument('title');
        }
    }
}
