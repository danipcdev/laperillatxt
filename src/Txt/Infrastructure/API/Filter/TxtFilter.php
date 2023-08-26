<?php

declare(strict_types=1);

namespace Txt\Infrastructure\API\Filter;

final class TxtFilter
{
    private const PAGE = 1;
    private const LIMIT = 9;
    private const ALLOWED_SORT_PARAMS = ['title'];
    private const ALLOWED_ORDER_PARAMS = ['asc', 'desc'];

    public readonly int $page;
    public readonly int $limit;

    public function __construct(
        int $page,
        int $limit,
        public readonly ?string $typeId,
        public readonly string $sort,
        public readonly string $order,
        public readonly ?string $title
    ) {
        if (0 !== $page) {
            $this->page = $page;
        } else {
            $this->page = self::PAGE;
        }

        if (0 !== $limit) {
            $this->limit = $limit;
        } else {
            $this->limit = self::LIMIT;
        }

        $this->validateSort($this->sort);
        $this->validateOrder($this->order);
    }

    private function validateSort(string $sort): void
    {
        if (!\in_array($sort, self::ALLOWED_SORT_PARAMS, true)) {
            throw new \InvalidArgumentException(\sprintf('Invalid sort param [%s]', $sort));
        }
    }

    private function validateOrder(string $order): void
    {
        if (!\in_array($order, self::ALLOWED_ORDER_PARAMS, true)) {
            throw new \InvalidArgumentException(\sprintf('Invalid order param [%s]', $order));
        }
    }
}