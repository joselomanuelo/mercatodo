<?php

namespace App\Constants;

use MyCLabs\Enum\Enum;

class Permissions extends Enum
{
    public const INDEX_USERS = 'index users';
    public const SHOW_USERS = 'show users';
    public const UPDATE_USERS = 'update users';
    public const DELETE_USERS = 'delete users';

    public static function supported(): array
    {
        return collect(static::toArray())->values()->toArray();
    }
}
