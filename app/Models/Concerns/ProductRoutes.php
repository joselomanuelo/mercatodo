<?php

namespace App\Models\Concerns;

use App\Constants\RouteNames;

trait ProductRoutes
{
    public static function indexRoute(): string
    {
        return route(RouteNames::INDEX_PRODUCTS);
    }

    public function showRoute(): string
    {
        return route(RouteNames::SHOW_PRODUCTS, $this);
    }

    public static function createRoute(): string
    {
        return route(RouteNames::CREATE_PRODUCTS);
    }

    public static function storeRoute(): string
    {
        return route(RouteNames::STORE_PRODUCTS);
    }

    public function editRoute(): string
    {
        return route(RouteNames::EDIT_PRODUCTS, $this);
    }

    public function updateRoute(): string
    {
        return route(RouteNames::UPDATE_PRODUCTS, $this);
    }

    public function destroyRoute(): string
    {
        return route(RouteNames::DESTROY_PRODUCTS, $this);
    }

    public static function buyerIndexRoute(): string
    {
        return route(RouteNames::BUYER_INDEX_PRODUCTS);
    }

    public function buyerShowRoute(): string
    {
        return route(RouteNames::BUYER_SHOW_PRODUCTS, $this);
    }

    public static function ApiIndexRoute(): string
    {
        return route(RouteNames::API_PRODUCTS);
    }
}
