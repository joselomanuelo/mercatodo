<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrdersResource;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Arr;

class OrdersController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return OrdersResource::collection(Order::all());
    }

    public function store(Request $request): OrdersResource
    {
        //dd($request);

        $apiOrder = json_decode($request->orders, true);

        $order = new Order();
        $order->user_id = $request->user_id;
        $order->price = Arr::get($apiOrder, 'price');
        $order->status = 'CREATED';
        $order->save();

        foreach (Arr::get($apiOrder, 'quantities') as $quantity) {
            $orderProduct = new OrderProduct();

            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = Arr::get($quantity, 'id');
            $orderProduct->user_id = $request->user_id;
            $orderProduct->amount = Arr::get($quantity, 'amount');
            $orderProduct->price = Arr::get($quantity, 'amount') * Arr::get($quantity, 'price');
            $orderProduct->save();
        }

        return new OrdersResource($order);
    }
}
