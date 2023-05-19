<?php

declare(strict_types=1);

namespace Txt\Application\UseCase\Txt\GetTxtById;

use Txt\Application\UseCase\Txt\GetTxtById\DTO\GetTxtByIdInputDTO;
use Txt\Application\UseCase\Txt\GetTxtById\DTO\GetTxtByIdOutputDTO;
use Txt\Domain\Repository\TxtRepository;

readonly class GetTxtById
{
    public function __construct(
        private TxtRepository $txtRepository
    ) {
    }

    public function handle(GetTxtByIdInputDTO $dto): GetTxtByIdOutputDTO
    {
        return GetTxtByIdOutputDTO::create($this->txtRepository->findOneByIdOrFail($dto->id));
    }
}
