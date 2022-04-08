<?php

namespace App\Models\Concerns;

use App\Constants\RouteNames;

trait CategoryRoutes
{
    public static function ApiIndexRoute(): string
    {
        return route(RouteNames::API_CATEGORIES);
    }
}
