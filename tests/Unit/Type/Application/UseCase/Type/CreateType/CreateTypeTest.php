<?php

declare(strict_types=1);

namespace App\Tests\Unit\Type\Application\UseCase\Type\CreateType;

use Type\Application\UseCase\Type\CreateType\CreateType;
use Type\Application\UseCase\Type\CreateType\DTO\CreateTypeInputDTO;
use Type\Application\UseCase\Type\CreateType\DTO\CreateTypeOutputDTO;
use Type\Domain\Model\Type;
use Type\Domain\Repository\TypeRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CreateTypeTest extends TestCase
{
    private const VALUES = [
        'name' => 'Microrrelato',
    ];

    private TypeRepository|MockObject $typeRepository;
    private CreateType $useCase;

    public function setUp(): void
    {
        $this->typeRepository = $this->createMock(TypeRepository::class);
        $this->useCase = new CreateType($this->typeRepository);
    }

    public function testCreateType(): void
    {
        $dto = CreateTypeInputDTO::create(
            self::VALUES['name'],
        );

        $this->typeRepository
            ->expects($this->once())
            ->method('save')
            ->with(
                $this->callback(function (Type $type): bool {
                    return $type->name() === self::VALUES['name'];
                })
            );

        $responseDTO = $this->useCase->handle($dto);

        self::assertInstanceOf(CreateTypeOutputDTO::class, $responseDTO);
    }
}