<?php

declare(strict_types=1);

namespace Type\Infrastructure\DTO;

use Symfony\Component\HttpFoundation\Request;

readonly class CreateTypeRequestDTO implements RequestDTO
{
    public ?string $name;

    public function __construct(Request $request)
    {
        $this->name = $request->request->get('name');
    }
}
