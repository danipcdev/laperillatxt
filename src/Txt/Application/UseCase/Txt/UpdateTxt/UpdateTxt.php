<?php

declare(strict_types=1);

namespace Txt\Application\UseCase\Txt\UpdateTxt;

use Txt\Application\UseCase\Txt\UpdateTxt\DTO\UpdateTxtInputDTO;
use Txt\Application\UseCase\Txt\UpdateTxt\DTO\UpdateTxtOutputDTO;
use Txt\Domain\Model\Txt;
use Txt\Domain\Repository\TxtRepository;
use Txt\Domain\ValueObject\Uuid;

readonly class UpdateTxt
{
    private const SETTER_PREFIX = 'set';

    public function __construct(
        private TxtRepository $txtRepository
    ) {
    }

    public function handle(UpdateTxtInputDTO $dto): UpdateTxtOutputDTO
    {
        $txt = $this->txtRepository->findOneByIdOrFail($dto->id);

        foreach ($dto->paramsToUpdate as $param) {
            if ($param === 'typeId') {
                $txt->setType($dto->type);
            } else {
                $txt->{\sprintf('%s%s', self::SETTER_PREFIX, \ucfirst($param))}($dto->{$param});
            }
        }

        $this->txtRepository->save($txt);

        return UpdateTxtOutputDTO::createFromModel($txt);
    }
}
