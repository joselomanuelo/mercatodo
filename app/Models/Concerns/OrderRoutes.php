<?php

namespace App\Models\Concerns;

use App\Constants\RouteNames;

trait OrderRoutes
{
    public static function ApiIndexRoute(): string
    {
        return route(RouteNames::API_ORDERS);
    }

    public function ApiShowRoute(): string
    {
        return route(RouteNames::API_SHOW_ORDERS, $this);
    }

    public static function ApiStoreRoute(): string
    {
        return route(RouteNames::API_STORE_ORDERS);
    }

    public static function ApiRetryRoute(): string
    {
        return route(RouteNames::API_RETRY_ORDERS);
    }
}
