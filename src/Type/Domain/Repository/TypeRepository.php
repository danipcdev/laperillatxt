<?php

declare(strict_types=1);

namespace Type\Domain\Repository;

use Type\Domain\Model\Type;

interface TypeRepository
{
    public function findOneByIdOrFail(string $id): Type;

    public function save(Type $type): void;

    public function remove(Type $type): void;
}
