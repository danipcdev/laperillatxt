<?php

declare(strict_types=1);

namespace Txt\Domain\Model;

class Txt
{
    private function __construct(
        private readonly string $id,
        private string $title,
        private string $text,
    ) {
    }

    public static function create(string $id, string $title, string $text): self
    {
        return new static($id, $title, $text);
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
}
