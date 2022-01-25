<?php

namespace App\Models\Concerns;

use Illuminate\Http\Request;

trait ProductRoutes
{
    public static function indexRoute(): string
    {
        return route('admin.products.index');
    }

    public function showRoute(): string
    {
        return route('admin.products.show', $this);
    }

    public static function createRoute(): string
    {
        return route('admin.products.create');
    }

    public static function storeRoute(): string
    {
        return route('admin.products.store');
    }

    public function editRoute(): string
    {
        return route('admin.products.edit', $this);
    }

    public function updateRoute(): string
    {
        return route('admin.products.update', $this);
    }

       public function destroyRoute(): string
    {
        return route('admin.products.destroy', $this);
    }
}
