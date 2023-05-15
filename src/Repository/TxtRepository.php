<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Txt;

interface TxtRepository
{
    public function save(Txt $txt): void;
}
