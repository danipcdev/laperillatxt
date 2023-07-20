<?php

declare(strict_types=1);

namespace Txt\Infrastructure\Controller\Txt;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Txt\Application\UseCase\Txt\Search\SearchTxts;
use Txt\Infrastructure\API\Filter\TxtFilter;
use Txt\Infrastructure\DTO\GetTxtsRequest;

final class SearchTxtController extends AbstractController
{
    public function __construct(
        private readonly SearchTxts $useCase
    ) {
    }

    public function __invoke(GetTxtsRequest $request): Response
    {
        $filter = new TxtFilter(
            $request->page,
            $request->limit,
            $request->typeId,
            $request->sort,
            $request->order,
            $request->title
        );

        $output = $this->useCase->execute($filter);

        return $this->json($output->txts);
    }
}