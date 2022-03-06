<?php

namespace App\Http\Controllers\Api;

use App\Actions\Orders\StoreOrRetryAction;
use App\Constants\OrderConstants;
use App\Events\OrderCreated;
use App\Helpers\PlacetoPayHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Orders\OrderRetryRequest;
use App\Http\Requests\Api\Orders\OrderStoreRequest;
use App\Http\Resources\OrdersResource;
use App\Models\Order;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrdersController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return OrdersResource::collection(Order::all());
    }

    public function store(OrderStoreRequest $request): OrdersResource
    {
        $order = StoreOrRetryAction::execute($request);

        PlacetoPayHelper::attempPayment($order);

        event(new OrderCreated($order));

        return new OrdersResource($order);
    }

    public function show(string $reference): OrdersResource
    {
        $order = Order::findOrFail($reference);

        if ($order->status == OrderConstants::PENDING) {
            PlacetoPayHelper::statusPayment($order);
        }

        return new OrdersResource($order);
    }

    public function retry(OrderRetryRequest $request): OrdersResource
    {
        $order = StoreOrRetryAction::execute($request);

        PlacetoPayHelper::attempPayment($order);

        return new OrdersResource($order);
    }
}
