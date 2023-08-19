<?php

declare(strict_types=1);

namespace Txt\Domain\Exception;

use InvalidArgumentException as NativeInvalidArgumentException;

class TxtAlreadyExistsException extends NativeInvalidArgumentException
{
    public static function fromTitle(string $title): self
    {
        return new self(\sprintf('Txt with title [%s] already exists', $title));
    }
}
