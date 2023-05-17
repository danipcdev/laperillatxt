<?php

declare(strict_types=1);

namespace Txt\Infrastructure\Database\ORM\Doctrine\Entity;

use Txt\Domain\Model\Txt;

class DoctrineTxt
{
    public function __construct(
        private readonly string $id,
        private string $title,
        private string $text,
    ) {
    }

    public static function createFromDomainTxt(Txt $txt): self
    {
        return new self($txt->id(), $txt->title(), $txt->text());
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
