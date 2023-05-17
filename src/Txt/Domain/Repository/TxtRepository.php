<?php

declare(strict_types=1);

namespace Txt\Domain\Repository;

use Txt\Domain\Model\Txt;

interface TxtRepository
{
    public function save(Txt $txt): void;
}
