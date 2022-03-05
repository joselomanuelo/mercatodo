<?php

namespace App\Contracts;

use App\Models\User;

abstract class AddInputUserLogs
{
    abstract public static function execute(User $user, string $type): void;
}
