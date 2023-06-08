<?php

declare(strict_types=1);

namespace Txt\Application\UseCase\Txt\CreateTxt;

use Txt\Application\UseCase\Txt\CreateTxt\DTO\CreateTxtInputDTO;
use Txt\Application\UseCase\Txt\CreateTxt\DTO\CreateTxtOutputDTO;
use Txt\Domain\Model\Txt;
use Txt\Domain\Repository\TxtRepository;
use Txt\Domain\ValueObject\Uuid;

readonly class CreateTxt
{
    public function __construct(private TxtRepository $repository)
    {
    }

    public function handle(CreateTxtInputDTO $dto): CreateTxtOutputDTO
    {
        $txt = Txt::create(Uuid::random()->value(), $dto->title, $dto->text);

        $this->repository->save($txt);

        return new CreateTxtOutputDTO($txt->id());
    }
}
