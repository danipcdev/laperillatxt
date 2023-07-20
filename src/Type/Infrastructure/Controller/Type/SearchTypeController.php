<?php

declare(strict_types=1);

namespace Type\Infrastructure\Controller\Type;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Type\Application\UseCase\Type\Search\SearchTypes;
use Type\Infrastructure\API\Filter\TypeFilter;
use Type\Infrastructure\DTO\GetTypesRequest;

final class SearchTypeController extends AbstractController
{
    public function __construct(
        private readonly SearchTypes $useCase
    ) {
    }

    public function __invoke(GetTypesRequest $request): Response
    {
        $filter = new TypeFilter(
            $request->page,
            $request->limit,
            $request->sort,
            $request->order,
            $request->name
        );

        $output = $this->useCase->execute($filter);

        return $this->json($output->types);
    }
}