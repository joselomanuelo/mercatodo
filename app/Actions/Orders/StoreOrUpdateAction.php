<?php

namespace App\Actions\Orders;

use App\Constants\OrderConstants;
use App\Contracts\Orders\StoreOrUpdateAction as Action;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class StoreOrUpdateAction extends Action
{
    public static function execute(Request $request): Order
    {
        $apiOrder = json_decode($request->orders, true);
        $order = new Order();
        $order->reference = Str::uuid();
        $order->user_id = '1';
        $order->price = Arr::get($apiOrder, 'price');
        $order->status = OrderConstants::CREATED;
        $order->save();

        foreach (Arr::get($apiOrder, 'quantities') as $quantity) {
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = Arr::get($quantity, 'id');
            $orderProduct->user_id = '1';
            $orderProduct->amount = Arr::get($quantity, 'amount');
            $orderProduct->price = Arr::get($quantity, 'amount') * Arr::get($quantity, 'price');
            $orderProduct->save();
        }

        return $order;
    }
}
