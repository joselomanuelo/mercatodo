<?php

namespace App\Listeners;

use App\Actions\Products\UpdateProductStockAction;
use App\Events\OrderCreated;

class OrderCreatedListener
{
    public function handle(OrderCreated $event)
    {
        UpdateProductStockAction::orderCreated($event->order);
    }
}
