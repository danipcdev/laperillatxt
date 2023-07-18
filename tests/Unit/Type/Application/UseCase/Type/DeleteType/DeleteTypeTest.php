<?php

declare(strict_types=1);

namespace App\Tests\Unit\Type\Application\UseCase\Type\CreateType;

use Type\Application\UseCase\Type\DeleteType\DeleteType;
use Type\Application\UseCase\Type\DeleteType\DTO\DeleteTypeInputDTO;
use Type\Domain\Model\Type;
use Type\Domain\Repository\TypeRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DeleteTypeTest extends TestCase
{
    private TypeRepository|MockObject $typeRepository;

    private DeleteType $useCase;

    public function setUp(): void
    {
        $this->typeRepository = $this->createMock(TypeRepository::class);

        $this->useCase = new DeleteType($this->typeRepository);
    }

    public function testDeleteType(): void
    {
        $typeId = '37fb348b-891a-4b1c-a4e4-a4a68a3c6bae';

        $type = Type::create(
            $typeId,
            'Microrrelato',
        );

        $inputDTO = DeleteTypeInputDTO::create($typeId);

        $this->typeRepository
            ->expects($this->once())
            ->method('findOneByIdOrFail')
            ->with($typeId)
            ->willReturn($type);

        $this->typeRepository
            ->expects($this->once())
            ->method('remove')
            ->with($type);

        $this->useCase->handle($inputDTO);
    }
}