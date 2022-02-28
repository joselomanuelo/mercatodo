<?php

namespace App\Http\Controllers\Api;

use App\Actions\Orders\StoreOrUpdateAction;
use App\Helpers\PlacetoPayHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrdersResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrdersController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return OrdersResource::collection(Order::all());
    }

    public function store(Request $request): OrdersResource
    {
        $order = StoreOrUpdateAction::execute($request);

        PlacetoPayHelper::attempPayment($order);

        return new OrdersResource($order);
    }
}
