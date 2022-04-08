<?php

namespace App\Actions\Products;

use App\Models\Order;
use App\Models\Product;

class ProductUpdateStockAction
{
    public static function orderCreated(Order $order)
    {
        foreach ($order->orderProduct as $orderProduct) {
            $product = Product::findOrFail($orderProduct->product_id);

            $product->reserved_stock += $orderProduct->amount;
            $product->stock -= $orderProduct->amount;

            $product->save();
        }
    }

    public static function orderApproved(Order $order)
    {
        foreach ($order->orderProduct as $orderProduct) {
            $product = Product::findOrFail($orderProduct->product_id);

            $product->reserved_stock -= $orderProduct->amount;

            $product->save();
        }
    }

    public static function orderRejected(Order $order)
    {
        foreach ($order->orderProduct as $orderProduct) {
            $product = Product::findOrFail($orderProduct->product_id);

            $product->reserved_stock -= $orderProduct->amount;
            $product->stock += $orderProduct->amount;

            $product->save();
        }
    }
}
