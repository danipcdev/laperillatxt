<?php

declare(strict_types=1);

namespace App\Tests\Unit\Type\Application\UseCase\Type\CreateType\DTO;

use Type\Application\UseCase\Type\CreateType\DTO\CreateTypeInputDTO;
use Type\Domain\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CreateTypeInputDTOTest extends TestCase
{
    private const VALUES = [
        'name' => 'Microrrelato',
    ];

    public function testCreate(): void
    {
        $dto = CreateTypeInputDTO::create(
            self::VALUES['name'],
        );

        self::assertInstanceOf(CreateTypeInputDTO::class, $dto);

        self::assertEquals(self::VALUES['name'], $dto->name);
    }

    public function testCreateWithNullValues(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Invalid arguments [name]');

        CreateTypeInputDTO::create(
            null,
        );
    }

    public function testNameLengthIsGreaterThan2(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Invalid argument [name]');

        CreateTypeInputDTO::create(
            'A',
        );
    }

    public function testNameLengthIsLessThan30(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Invalid argument [name]');

        CreateTypeInputDTO::create(
            'asdfghrtyuiasdfghrtyuiasdfghrtyuiasdfghrtyui',
        );
    }
}