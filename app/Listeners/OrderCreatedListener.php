<?php

namespace App\Listeners;

use App\Actions\Products\UpdateProductStockAction;
use App\Events\OrderCreatedEvent;
use Illuminate\Support\Facades\Log;

class OrderCreatedListener
{
    public function handle(OrderCreatedEvent $event)
    {
        UpdateProductStockAction::orderCreated($event->order);

        Log::info('The order with Id ' . $event->order->id . ' has been created.');
    }
}
