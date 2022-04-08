<?php

namespace App\Listeners;

use App\Actions\Products\ProductUpdateStockAction;
use App\Events\OrderApprovedEvent;
use App\Mail\Orders\OrderApprovedMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderApprovedListener
{
    public function handle(OrderApprovedEvent $event)
    {
        ProductUpdateStockAction::orderApproved($event->order);

        Mail::to($event->order->user->email)->send(new OrderApprovedMail());

        Log::info('The order with Id ' . $event->order->id . ' has been approved.');
    }
}
