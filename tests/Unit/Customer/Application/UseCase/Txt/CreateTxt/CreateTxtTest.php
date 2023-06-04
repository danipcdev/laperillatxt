<?php

declare(strict_types=1);

namespace App\Tests\Unit\Txt\Application\UseCase\Txt\CreateTxt;

use Txt\Application\UseCase\Txt\CreateTxt\CreateTxt;
use Txt\Application\UseCase\Txt\CreateTxt\DTO\CreateTxtInputDTO;
use Txt\Application\UseCase\Txt\CreateTxt\DTO\CreateTxtOutputDTO;
use Txt\Domain\Model\Txt;
use Txt\Domain\Repository\TxtRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CreateTxtTest extends TestCase
{
    private const VALUES = [
        'title' => 'Test Title',
        'text' => 'Test Text',
    ];

    private TxtRepository|MockObject $txtRepository;
    private CreateTxt $useCase;

    public function setUp(): void
    {
        $this->txtRepository = $this->createMock(TxtRepository::class);
        $this->useCase = new CreateTxt($this->txtRepository);
    }

    public function testCreateTxt(): void
    {
        $dto = CreateTxtInputDTO::create(
            self::VALUES['title'],
            self::VALUES['text'],
        );

        $this->txtRepository
            ->expects($this->once())
            ->method('save')
            ->with(
                $this->callback(function (Txt $txt): bool {
                    return $txt->title() === self::VALUES['title']
                        && $txt->text() === self::VALUES['text'];
                })
            );

        $responseDTO = $this->useCase->handle($dto);

        self::assertInstanceOf(CreateTxtOutputDTO::class, $responseDTO);
    }
}