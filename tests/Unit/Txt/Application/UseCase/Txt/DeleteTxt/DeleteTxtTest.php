<?php

declare(strict_types=1);

namespace App\Tests\Unit\Txt\Application\UseCase\Txt\CreateTxt;

use Txt\Application\UseCase\Txt\DeleteTxt\DeleteTxt;
use Txt\Application\UseCase\Txt\DeleteTxt\DTO\DeleteTxtInputDTO;
use Txt\Domain\Model\Txt;
use Txt\Domain\Repository\TxtRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DeleteTxtTest extends TestCase
{
    private TxtRepository|MockObject $txtRepository;

    private DeleteTxt $useCase;

    public function setUp(): void
    {
        $this->txtRepository = $this->createMock(TxtRepository::class);

        $this->useCase = new DeleteTxt($this->txtRepository);
    }

    public function testDeleteTxt(): void
    {
        $txtId = '37fb348b-891a-4b1c-a4e4-a4a68a3c6bae';

        $txt = Txt::create(
            $txtId,
            'Txt de prueba',
            'Texto del txt de prueba',
        );

        $inputDTO = DeleteTxtInputDTO::create($txtId);

        $this->txtRepository
            ->expects($this->once())
            ->method('findOneByIdOrFail')
            ->with($txtId)
            ->willReturn($txt);

        $this->txtRepository
            ->expects($this->once())
            ->method('remove')
            ->with($txt);

        $this->useCase->handle($inputDTO);
    }
}