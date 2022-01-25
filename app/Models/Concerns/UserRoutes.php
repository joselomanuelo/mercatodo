<?php

namespace App\Models\Concerns;

use Illuminate\Http\Request;

trait UserRoutes
{
    public static function indexRoute(): string
    {
        return route('admin.users.index');
    }

    public function showRoute(): string
    {
        return route('admin.users.show', $this);
    }

    public function editRoute(): string
    {
        return route('admin.users.edit', $this);
    }

    public function updateRoute(): string
    {
        return route('admin.users.update', $this);
    }

    public function toggleRoute(): string
    {
        return route('admin.users.toggle', $this);
    }

    public function destroyRoute(): string
    {
        return route('admin.users.destroy', $this);
    }
}
