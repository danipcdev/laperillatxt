<?php

declare(strict_types=1);

namespace Txt\Application\UseCase\Txt\CreateTxt;

use Txt\Application\UseCase\Txt\CreateTxt\DTO\CreateTxtInputDTO;
use Txt\Application\UseCase\Txt\CreateTxt\DTO\CreateTxtOutputDTO;
use Txt\Domain\Exception\TxtAlreadyExistsException;
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
        if (null !== $this->repository->findOneByTitle($dto->title)) {
            throw TxtAlreadyExistsException::fromTitle($dto->title);
        }

        $txt = Txt::create(Uuid::random()->value(), $dto->title, $dto->text, $dto->type);

        $this->repository->save($txt);

        return new CreateTxtOutputDTO($txt->id());
    }
}
