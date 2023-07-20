<?php

declare(strict_types=1);

namespace Txt\Infrastructure\DTO;

use Symfony\Component\HttpFoundation\Request;

final class GetTxtsRequest implements RequestDTO
{
    public readonly int $page;
    public readonly int $limit;
    public readonly ?string $typeId;
    public readonly string $sort;
    public readonly string $order;
    public readonly ?string $title;

    public function __construct(Request $request)
    {
        $this->page = $request->query->getInt('page');
        $this->limit = $request->query->getInt('limit');
        $this->typeId = $request->query->get('typeId');
        $this->sort = $request->query->get('sort');
        $this->order = $request->query->get('order');
        $this->title = $request->query->get('title');
    }
}