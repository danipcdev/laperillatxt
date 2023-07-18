<?php

declare(strict_types=1);

namespace Type\Infrastructure\DTO;

use Symfony\Component\HttpFoundation\Request;

readonly class DeleteTypeRequestDTO implements RequestDTO
{
    public ?string $id;

    public function __construct(Request $request)
    {
        $this->id = $request->attributes->get('id');
    }
}
