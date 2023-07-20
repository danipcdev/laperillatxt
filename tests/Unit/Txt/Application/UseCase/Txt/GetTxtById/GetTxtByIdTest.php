<?php

declare(strict_types=1);

namespace App\Tests\Unit\Txt\Application\UseCase\Txt\GetTxtById;

use Txt\Application\UseCase\Txt\GetTxtById\DTO\GetTxtByIdInputDTO;
use Txt\Application\UseCase\Txt\GetTxtById\DTO\GetTxtByIdOutputDTO;
use Txt\Application\UseCase\Txt\GetTxtById\GetTxtById;
use Txt\Domain\Exception\ResourceNotFoundException;
use Txt\Domain\Model\Txt;
use Txt\Domain\Repository\TxtRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class GetTxtByIdTest extends TestCase
{
    private const TXT_DATA = [
        'id' => '9b5c0b1f-09bf-4fed-acc9-fcaafc933a19',
        'title' => 'Title de prueba',
        'text' => 'Text de prueba',
    ];

    private TxtRepository|MockObject $txtRepository;

    private GetTxtById $useCase;

    public function setUp(): void
    {
        $this->txtRepository = $this->createMock(TxtRepository::class);

        $this->useCase = new GetTxtById($this->txtRepository);
    }

    public function testGetTxtById(): void
    {
        $inputDto = GetTxtByIdInputDTO::create(self::TXT_DATA['id']);

        $txt = Txt::create(
            self::TXT_DATA['id'],
            self::TXT_DATA['title'],
            self::TXT_DATA['text'],
        );

        $this->txtRepository
            ->expects($this->once())
            ->method('findOneByIdOrFail')
            ->with($inputDto->id)
            ->willReturn($txt);

        $responseDTO = $this->useCase->handle($inputDto);

        self::assertInstanceOf(GetTxtByIdOutputDTO::class, $responseDTO);

        self::assertEquals(self::TXT_DATA['id'], $responseDTO->id);
        self::assertEquals(self::TXT_DATA['title'], $responseDTO->title);
        self::assertEquals(self::TXT_DATA['text'], $responseDTO->text);
    }

    public function testGetTxtByIdException(): void
    {
        $inputDto = GetTxtByIdInputDTO::create(self::TXT_DATA['id']);

        $this->txtRepository
            ->expects($this->once())
            ->method('findOneByIdOrFail')
            ->with($inputDto->id)
            ->willThrowException(ResourceNotFoundException::createFromClassAndId(Txt::class, $inputDto->id));

        self::expectException(ResourceNotFoundException::class);

        $this->useCase->handle($inputDto);
    }
}