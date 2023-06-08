<?php

declare(strict_types=1);

namespace Txt\Application\UseCase\Txt\DeleteTxt;

use Txt\Application\UseCase\Txt\DeleteTxt\DTO\DeleteTxtInputDTO;
use Txt\Domain\Repository\TxtRepository;

readonly class DeleteTxt
{
    public function __construct(private TxtRepository $repository)
    {
    }

    public function handle(DeleteTxtInputDTO $dto): void
    {
        $txt = $this->repository->findOneByIdOrFail($dto->id);

        $this->repository->remove($txt);
    }
}
