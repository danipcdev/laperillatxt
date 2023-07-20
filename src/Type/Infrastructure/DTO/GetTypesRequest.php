<?php

declare(strict_types=1);

namespace Type\Infrastructure\DTO;

use Symfony\Component\HttpFoundation\Request;
use Type\Infrastructure\DTO\RequestDTO;

final class GetTypesRequest implements RequestDTO
{
    public readonly int $page;
    public readonly int $limit;
    public readonly string $sort;
    public readonly string $order;
    public readonly ?string $name;

    public function __construct(Request $request)
    {
        $this->page = $request->query->getInt('page');
        $this->limit = $request->query->getInt('limit');
        $this->sort = $request->query->get('sort');
        $this->order = $request->query->get('order');
        $this->name = $request->query->get('name');
    }
}