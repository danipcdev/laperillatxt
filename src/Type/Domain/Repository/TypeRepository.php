<?php

declare(strict_types=1);

namespace Type\Domain\Repository;

use Type\Domain\Model\Type;
use Type\Infrastructure\API\Filter\TypeFilter;
use Type\Infrastructure\API\Response\PaginatedResponse;

interface TypeRepository
{
    public function findOneByIdOrFail(string $id): Type;

    public function search(TypeFilter $filter): PaginatedResponse;

    public function save(Type $type): void;

    public function remove(Type $type): void;
}
