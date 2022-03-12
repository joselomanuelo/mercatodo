<?php

namespace App\Listeners;

use App\Actions\Products\UpdateProductStockAction;
use App\Events\OrderCreated;
use Illuminate\Support\Facades\Log;

class OrderCreatedListener
{
    public function handle(OrderCreated $event)
    {
        UpdateProductStockAction::orderCreated($event->order);

        Log::info('The order with Id ' . $event->order->id . ' has been created.');
    }
}
