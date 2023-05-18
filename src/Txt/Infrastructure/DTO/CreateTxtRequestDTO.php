<?php

declare(strict_types=1);

namespace Txt\Infrastructure\DTO;

use Symfony\Component\HttpFoundation\Request;

readonly class CreateTxtRequestDTO implements RequestDTO
{
    public ?string $title;
    public ?string $text;

    public function __construct(Request $request)
    {
        $this->title = $request->request->get('title');
        $this->text = $request->request->get('text');
    }
}
