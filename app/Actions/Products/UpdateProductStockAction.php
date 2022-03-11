<?php

namespace App\Actions\Products;

use App\Models\Order;

class UpdateProductStockAction
{
    public static function orderCreated(Order $order)
    {
        foreach ($order->orderProducts as $orderProduct) {
            $product = $orderProduct->product;

            $product->reserved_stock += $orderProduct->amount;
            $product->stock -= $orderProduct->amount;

            $product->save();
        }
    }

    public static function orderApproved(Order $order)
    {
        foreach ($order->orderProducts as $orderProduct) {
            $product = $orderProduct->product;

            $product->reserved_stock -= $orderProduct->amount;

            $product->save();
        }
    }

    public static function orderRejected(Order $order)
    {
        foreach ($order->orderProducts as $orderProduct) {
            $product = $orderProduct->product;

            $product->reserved_stock -= $orderProduct->amount;
            $product->stock += $orderProduct->amount;

            $product->save();
        }
    }
}
