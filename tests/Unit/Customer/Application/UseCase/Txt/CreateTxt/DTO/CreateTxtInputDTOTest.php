<?php

declare(strict_types=1);

namespace App\Tests\Unit\Txt\Application\UseCase\Txt\CreateTxt\DTO;

use Txt\Application\UseCase\Txt\CreateTxt\DTO\CreateTxtInputDTO;
use Txt\Domain\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CreateTxtInputDTOTest extends TestCase
{
    private const VALUES = [
        'title' => 'Test Title',
        'text' => 'Test Text',
    ];

    public function testCreate(): void
    {
        $dto = CreateTxtInputDTO::create(
            self::VALUES['title'],
            self::VALUES['text'],
        );

        self::assertInstanceOf(CreateTxtInputDTO::class, $dto);

        self::assertEquals(self::VALUES['title'], $dto->title);
        self::assertEquals(self::VALUES['text'], $dto->text);
    }

    public function testCreateWithNullValues(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Invalid arguments [title]');

        CreateTxtInputDTO::create(
            null,
            self::VALUES['text'],
        );
    }

    public function testTitleLengthIsGreaterThan2(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Invalid argument [title]');

        CreateTxtInputDTO::create(
            'A',
            self::VALUES['text'],
        );
    }

    public function testTitleLengthIsLessThan40(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Invalid argument [title]');

        CreateTxtInputDTO::create(
            'asdfghrtyuiasdfghrtyuiasdfghrtyuiasdfghrtyui',
            self::VALUES['text'],
        );
    }
}