<?php

declare(strict_types=1);

namespace Type\Application\UseCase\Type\Search\DTO;

use Type\Domain\Model\Type;
use Type\Infrastructure\API\Response\PaginatedResponse;

final readonly class SearchTypesOutput
{
    private function __construct(
        public array $types
    ) {
    }

    public static function createFromPaginatedResponse(PaginatedResponse $paginatedResponse): self
    {
        $items = \array_map(function (Type $type): array {
            return [
                'id' => $type->id(),
                'title' => $type->name(),
            ];
        }, $paginatedResponse->getItems());

        $response['items'] = $items;
        $response['meta'] = $paginatedResponse->getMeta();

        return new SearchTypesOutput($response);
    }
}