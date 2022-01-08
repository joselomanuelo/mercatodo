<?php

namespace App\Constants;

use MyCLabs\Enum\Enum;

class Roles extends Enum
{
    public const ADMIN = 'admin';
    public const BUYER = 'buyer';

    public static function supported(): array
    {
        return collect(static::toArray())->values()->toArray();
    }
}
