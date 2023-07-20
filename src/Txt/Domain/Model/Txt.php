<?php

declare(strict_types=1);

namespace Txt\Domain\Model;

use Type\Domain\Model\Type;

class Txt
{
    public const TITLE_MIN_LENGTH = 2;
    public const TITLE_MAX_LENGTH = 40;

    private function __construct(
        private readonly string $id,
        private string $title,
        private string $text,
        private Type $type,
    ) {
    }

    public static function create(string $id, string $title, string $text, Type $type): self
    {
        return new static($id, $title, $text, $type);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function text(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }

    public function type(): Type
    {
        return $this->type;
    }

    public function setType(Type $type): void
    {
        $this->type = $type;
    }
}
