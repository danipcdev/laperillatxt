<?php

declare(strict_types=1);

namespace Txt\Domain\Repository;

use Txt\Domain\Model\Txt;
use Txt\Infrastructure\API\Filter\TxtFilter;
use Txt\Infrastructure\API\Response\PaginatedResponse;

interface TxtRepository
{
    public function findOneByIdOrFail(string $id): Txt;

    public function findOneByTitle(string $title);

    public function search(TxtFilter $filter): PaginatedResponse;

    public function save(Txt $txt): void;

    public function remove(Txt $txt): void;
}
