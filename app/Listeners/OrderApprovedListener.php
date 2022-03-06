<?php

namespace App\Listeners;

use App\Actions\Products\UpdateProductStockAction;
use App\Events\OrderApproved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class OrderApprovedListener
{
    public function handle(OrderApproved $event)
    {
        UpdateProductStockAction::orderApproved($event->order);
        
    }
}
