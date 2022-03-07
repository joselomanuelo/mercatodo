<?php

namespace App\Listeners;

use App\Actions\Products\UpdateProductStockAction;
use App\Events\OrderApproved;
use App\Mail\Orders\OrderApprovedMail;
use Illuminate\Support\Facades\Mail;

class OrderApprovedListener
{
    public function handle(OrderApproved $event)
    {
        UpdateProductStockAction::orderApproved($event->order);

        Mail::to($event->order->user->email)->send(new OrderApprovedMail());
    }
}
