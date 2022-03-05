<?php

namespace App\Actions\Orders;

use App\Constants\OrderConstants;
use App\Contracts\Orders\StoreOrUpdateAction as Action;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StoreOrUpdateAction extends Action
{
    public static function execute(Request $request): Order
    {
        $apiOrder = json_decode($request->order, true);
        $apiPrice = json_decode($request->price);

        $order = new Order();
        $order->reference = Str::uuid()->toString();
        $order->user_id = Auth::user()->id;
        $order->price = $apiPrice;
        $order->status = OrderConstants::PENDING;
        $order->save();

        foreach ($apiOrder as $item) {
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = Arr::get($item, 'id');
            $orderProduct->user_id = '1';
            $orderProduct->amount = Arr::get($item, 'amount');
            $orderProduct->price = Arr::get($item, 'amount') * Arr::get($item, 'price');
            $orderProduct->save();
        }

        return $order;
    }
}
