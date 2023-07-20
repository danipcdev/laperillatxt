<?php

declare(strict_types=1);

namespace Txt\Application\UseCase\Txt\Search\DTO;

use Txt\Domain\Model\Txt;
use Txt\Infrastructure\API\Response\PaginatedResponse;

final readonly class SearchTxtsOutput
{
    private function __construct(
        public array $txts
    ) {
    }

    public static function createFromPaginatedResponse(PaginatedResponse $paginatedResponse): self
    {
        $items = \array_map(function (Txt $txt): array {
            $items['type']['id'] = $txt->type()->id();
            $items['type']['name'] = $txt->type()->name();
            return [
                'id' => $txt->id(),
                'title' => $txt->title(),
                'text' => $txt->text(),
                'type' => $items['type'],
            ];
        }, $paginatedResponse->getItems());

        $response['items'] = $items;
        $response['meta'] = $paginatedResponse->getMeta();

        return new SearchTxtsOutput($response);
    }
}