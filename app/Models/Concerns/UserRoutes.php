<?php

namespace App\Models\Concerns;

use Illuminate\Http\Request;

trait UserRoutes
{
    public static function indexRoute(Request $request): string
    {
        return route('admin.users.index', $request);
    }

    public function showRoute(): string
    {
        return route('admin.users.show', $this);
    }
}
