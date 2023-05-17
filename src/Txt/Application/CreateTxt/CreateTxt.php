<?php

declare(strict_types=1);

namespace Txt\Application\CreateTxt;

use Txt\Application\CreateTxt\DTO\CreateTxtInputDTO;
use Txt\Application\CreateTxt\DTO\CreateTxtOutputDTO;
use Txt\Domain\Model\Txt;
use Txt\Domain\Repository\TxtRepository;
use Txt\Domain\ValueObject\Uuid;

readonly class CreateTxt
{
    public function __construct(private TxtRepository $repository)
    {
    }

    public function __invoke(CreateTxtInputDTO $dto): CreateTxtOutputDTO
    {
        $txt = new Txt(Uuid::random()->value(), $dto->title, $dto->text);

        $this->repository->save($txt);

        return new CreateTxtOutputDTO($txt->id());
    }
}
