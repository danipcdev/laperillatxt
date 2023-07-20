<?php

declare(strict_types=1);

namespace Type\Application\UseCase\Type\Search;

use Type\Infrastructure\API\Filter\TypeFilter;
use Type\Application\UseCase\Type\Search\DTO\SearchTypesOutput;
use Type\Domain\Repository\TypeRepository;

final readonly class SearchTypes
{
    public function __construct(
        private TypeRepository $typeRepository
    ) {
    }

    public function execute(TypeFilter $filter): SearchTypesOutput
    {
        $paginatedResponse = $this->typeRepository->search($filter);

        return SearchTypesOutput::createFromPaginatedResponse($paginatedResponse);
    }
}