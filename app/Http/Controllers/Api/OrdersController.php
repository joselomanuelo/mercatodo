<?php

namespace App\Http\Controllers\Api;

use App\Actions\Orders\StoreOrRetryAction;
use App\Constants\OrderConstants;
use App\Events\OrderCreated;
use App\Helpers\PlacetoPayHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Orders\OrderStoreRequest;
use App\Http\Resources\OrdersResource;
use App\Models\Order;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $orders = Order::where('user_id', Auth::user()->id)->get();

        return OrdersResource::collection($orders);
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
}
