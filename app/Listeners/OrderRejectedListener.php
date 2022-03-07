<?php

namespace App\Listeners;

use App\Actions\Products\UpdateProductStockAction;
use App\Events\OrderRejected;
use App\Mail\Orders\OrderRejectedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class OrderRejectedListener
{
    public function handle(OrderRejected $event)
    {
        UpdateProductStockAction::orderRejected($event->order);
        Mail::to($event->order->user->email)->send(new OrderRejectedMail());
        
    }
}
