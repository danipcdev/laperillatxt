<?php

declare(strict_types=1);

namespace Txt\Infrastructure\DTO;

use Symfony\Component\HttpFoundation\Request;

readonly class UpdateTxtRequestDTO implements RequestDTO
{
    public ?string $id;
    public ?string $title;
    public ?string $text;
    public ?string $typeId;
    public array $keys;

    public function __construct(Request $request)
    {
        $this->id = $request->attributes->get('id');
        $this->title = $request->request->get('title');
        $this->text = $request->request->get('text');
        $this->typeId = $request->request->get('typeId');
        $this->keys = \array_keys($request->request->all());
    }
}
