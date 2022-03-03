<?php

namespace App\Models\Concerns;

trait ProductViews
{
    public static function indexView(): string
    {
        return 'admin.products.index';
    }

    public static function showView(): string
    {
        return 'admin.products.show';
    }

    public static function createView(): string
    {
        return 'admin.products.create';
    }

    public static function editView(): string
    {
        return 'admin.products.edit';
    }

    public static function buyerIndexView(): string
    {
        return 'buyer.products.index';
    }

    public static function buyerShowView(): string
    {
        return 'buyer.products.show';
    }
}
