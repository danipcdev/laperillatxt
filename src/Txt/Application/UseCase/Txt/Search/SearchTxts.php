<?php

declare(strict_types=1);

namespace Txt\Application\UseCase\Txt\Search;

use Txt\Infrastructure\API\Filter\TxtFilter;
use Txt\Application\UseCase\Txt\Search\DTO\SearchTxtsOutput;
use Txt\Domain\Repository\TxtRepository;

final readonly class SearchTxts
{
    public function __construct(
        private TxtRepository $txtRepository
    ) {
    }

    public function execute(TxtFilter $filter): SearchTxtsOutput
    {
        $paginatedResponse = $this->txtRepository->search($filter);

        return SearchTxtsOutput::createFromPaginatedResponse($paginatedResponse);
    }
}