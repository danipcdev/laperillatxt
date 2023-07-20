<?php

declare(strict_types=1);

namespace Type\Infrastructure\DTO;

use Symfony\Component\HttpFoundation\Request;

readonly class UpdateTypeRequestDTO implements RequestDTO
{
    public ?string $id;
    public ?string $name;
    public array $keys;

    public function __construct(Request $request)
    {
        $this->id = $request->attributes->get('id');
        $this->name = $request->request->get('name');
        $this->keys = \array_keys($request->request->all());
    }
}
