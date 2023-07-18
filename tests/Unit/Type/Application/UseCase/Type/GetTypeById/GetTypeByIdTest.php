<?php

declare(strict_types=1);

namespace App\Tests\Unit\Type\Application\UseCase\Type\GetTypeById;

use Type\Application\UseCase\Type\GetTypeById\DTO\GetTypeByIdInputDTO;
use Type\Application\UseCase\Type\GetTypeById\DTO\GetTypeByIdOutputDTO;
use Type\Application\UseCase\Type\GetTypeById\GetTypeById;
use Type\Domain\Exception\ResourceNotFoundException;
use Type\Domain\Model\Type;
use Type\Domain\Repository\TypeRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class GetTypeByIdTest extends TestCase
{
    private const TXT_DATA = [
        'id' => '9b5c0b1f-09bf-4fed-acc9-fcaafc933a19',
        'name' => 'Microrrelato',
    ];

    private TypeRepository|MockObject $typeRepository;

    private GetTypeById $useCase;

    public function setUp(): void
    {
        $this->typeRepository = $this->createMock(TypeRepository::class);

        $this->useCase = new GetTypeById($this->typeRepository);
    }

    public function testGetTypeById(): void
    {
        $inputDto = GetTypeByIdInputDTO::create(self::TXT_DATA['id']);

        $type = Type::create(
            self::TXT_DATA['id'],
            self::TXT_DATA['name'],
        );

        $this->typeRepository
            ->expects($this->once())
            ->method('findOneByIdOrFail')
            ->with($inputDto->id)
            ->willReturn($type);

        $responseDTO = $this->useCase->handle($inputDto);

        self::assertInstanceOf(GetTypeByIdOutputDTO::class, $responseDTO);

        self::assertEquals(self::TXT_DATA['id'], $responseDTO->id);
        self::assertEquals(self::TXT_DATA['name'], $responseDTO->name);
    }

    public function testGetTypeByIdException(): void
    {
        $inputDto = GetTypeByIdInputDTO::create(self::TXT_DATA['id']);

        $this->typeRepository
            ->expects($this->once())
            ->method('findOneByIdOrFail')
            ->with($inputDto->id)
            ->willThrowException(ResourceNotFoundException::createFromClassAndId(Type::class, $inputDto->id));

        self::expectException(ResourceNotFoundException::class);

        $this->useCase->handle($inputDto);
    }
}