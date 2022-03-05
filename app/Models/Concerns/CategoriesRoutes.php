<?php

namespace App\Models\Concerns;

use App\Constants\RouteNames;

trait CategoriesRoutes
{
    public static function ApiIndexRoute(): string
    {
        return route(RouteNames::API_CATEGORIES);
    }
}
