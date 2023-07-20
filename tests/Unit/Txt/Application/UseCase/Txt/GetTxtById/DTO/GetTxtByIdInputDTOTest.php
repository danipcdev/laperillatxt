<?php

declare(strict_types=1);

namespace App\Tests\Unit\Txt\Application\UseCase\Txt\GetTxtById\DTO;

use Txt\Application\UseCase\Txt\GetTxtById\DTO\GetTxtByIdInputDTO;
use Txt\Domain\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class GetTxtByIdInputDTOTest extends TestCase
{
    private const TXT_ID = '9b5c0b1f-09bf-4fed-acc9-fcaafc933a19';

    public function testCreateGetTxtByIdInputDTO(): void
    {
        $dto = GetTxtByIdInputDTO::create(self::TXT_ID);

        self::assertInstanceOf(GetTxtByIdInputDTO::class, $dto);
        self::assertEquals(self::TXT_ID, $dto->id);
    }

    public function testCreateGetTxtByIdInputDTOWithNullValue(): void
    {
        self::expectException(InvalidArgumentException::class);
        self::expectExceptionMessage('Invalid arguments [id]');

        GetTxtByIdInputDTO::create(null);
    }
}