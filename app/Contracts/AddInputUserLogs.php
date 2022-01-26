<?php

namespace App\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

abstract class AddInputUserLogs
{
    abstract public static function execute(User $user, string $type): void;
}
