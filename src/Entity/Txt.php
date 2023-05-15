<?php

declare(strict_types=1);

namespace App\Entity;

readonly class Txt
{
    public function __construct(
        private string $id,
        private string $title,
        private string $text,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getText(): string
    {
        return $this->text;
    }
}
