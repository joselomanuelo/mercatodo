<?php

namespace App\Listeners;

use App\Actions\Products\ProductUpdateStockAction;
use App\Events\OrderCreatedEvent;
use Illuminate\Support\Facades\Log;

class OrderCreatedListener
{
    public function handle(OrderCreatedEvent $event)
    {
        ProductUpdateStockAction::orderCreated($event->order);

        Log::info('The order with Id ' . $event->order->id . ' has been created.');
    }
}
