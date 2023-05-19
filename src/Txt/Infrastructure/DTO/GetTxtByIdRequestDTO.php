<?php

declare(strict_types=1);

namespace Txt\Infrastructure\DTO;

use Symfony\Component\HttpFoundation\Request;

readonly class GetTxtByIdRequestDTO implements RequestDTO
{
    public ?string $id;

    public function __construct(Request $request)
    {
        $this->id = $request->attributes->get('id');
    }
}
