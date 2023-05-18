<?php

declare(strict_types=1);

namespace Txt\Infrastructure\DTO;

use Symfony\Component\HttpFoundation\Request;

interface RequestDTO
{
    public function __construct(Request $request);
}
