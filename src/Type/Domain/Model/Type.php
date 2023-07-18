<?php

declare(strict_types=1);

namespace Type\Domain\Model;

class Type
{
    private function __construct(
        private string $id,
        private string $name,
    ) {
    }

    public static function create(string $id, string $name): self
    {
        return new static($id, $name);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
