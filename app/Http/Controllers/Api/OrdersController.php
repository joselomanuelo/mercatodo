<?php

namespace App\Http\Controllers\Api;

use App\Actions\Orders\StoreOrUpdateAction;
use App\Helpers\PlacetoPayHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderRequest;
use App\Http\Resources\OrdersResource;
use App\Models\Order;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrdersController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return OrdersResource::collection(Order::all());
    }

    public function store(OrderRequest $request): OrdersResource
    {
        $order = StoreOrUpdateAction::execute($request);

        PlacetoPayHelper::attempPayment($order);

        return new OrdersResource($order);
    }

    public function show(string $reference): OrdersResource
    {
        $order = Order::findOrFail($reference);

        PlacetoPayHelper::statusPayment($order);

        return new OrdersResource($order);
    }
}
