<?php

namespace App\Listeners;

use App\Actions\Products\UpdateProductStockAction;
use App\Events\OrderRejected;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderRejectedListener
{
    public function handle(OrderRejected $event)
    {
        UpdateProductStockAction::orderRejected($event->order);
        
    }
}
