<?php

namespace App\Models\Concerns;

trait UserViews
{
    public static function indexView(): string
    {
        return 'admin.users.index';
    }

    public static function showView(): string
    {
        return 'admin.users.show';
    }

    public static function editView(): string
    {
        return 'admin.users.edit';
    }
}
