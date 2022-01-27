<?php

namespace App\Models\Concerns;

use App\Constants\RouteNames;

trait UserRoutes
{
    public static function indexRoute(): string
    {
        return route(RouteNames::INDEX_USERS);
    }

    public function showRoute(): string
    {
        return route(RouteNames::SHOW_USERS, $this);
    }

    public function editRoute(): string
    {
        return route(RouteNames::EDIT_USERS, $this);
    }

    public function updateRoute(): string
    {
        return route(RouteNames::UPDATE_USERS, $this);
    }

    public function toggleRoute(): string
    {
        return route(RouteNames::TOGGLE_USERS, $this);
    }

    public function destroyRoute(): string
    {
        return route(RouteNames::DESTROY_USERS, $this);
    }
}
