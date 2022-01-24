<?php

namespace App\Constants;

use MyCLabs\Enum\Enum;

class Constant extends Enum
{
    public static function supported(): array
    {
        return collect(static::toArray())->values()->toArray();
    }
}
