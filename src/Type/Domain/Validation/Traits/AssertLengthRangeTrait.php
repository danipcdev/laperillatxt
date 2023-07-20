<?php

declare(strict_types=1);

namespace Type\Domain\Validation\Traits;

use Type\Domain\Exception\InvalidArgumentException;

trait AssertLengthRangeTrait
{
    public function assertValueRangeLength(string $value, int $min, int $max): void
    {
        if (\strlen($value) < $min || \strlen($value) > $max) {
            throw InvalidArgumentException::createFromMinAndMaxLength($min, $max);
        }
    }
}
