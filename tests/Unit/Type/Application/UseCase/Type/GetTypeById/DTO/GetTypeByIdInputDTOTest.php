<?php

declare(strict_types=1);

namespace App\Tests\Unit\Type\Application\UseCase\Type\GetTypeById\DTO;

use Type\Application\UseCase\Type\GetTypeById\DTO\GetTypeByIdInputDTO;
use Type\Domain\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class GetTypeByIdInputDTOTest extends TestCase
{
    private const TXT_ID = '9b5c0b1f-09bf-4fed-acc9-fcaafc933a19';

    public function testCreateGetTypeByIdInputDTO(): void
    {
        $dto = GetTypeByIdInputDTO::create(self::TXT_ID);

        self::assertInstanceOf(GetTypeByIdInputDTO::class, $dto);
        self::assertEquals(self::TXT_ID, $dto->id);
    }

    public function testCreateGetTypeByIdInputDTOWithNullValue(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Invalid arguments [id]');

        GetTypeByIdInputDTO::create(null);
    }
}