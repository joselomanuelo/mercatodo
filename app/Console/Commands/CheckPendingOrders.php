<?php

namespace App\Console\Commands;

use App\Constants\OrderConstants;
use App\Events\OrderApproved;
use App\Helpers\PlacetoPayHelper;
use App\Models\Order;
use Illuminate\Console\Command;

class CheckPendingOrders extends Command
{
    protected $signature = 'orders:pending';

    protected $description = 'Check the pendings orders';

    public function handle()
    {
        $orders = Order::whereDate('created_at', '>=', now()->subHours(OrderConstants::DURATION + 1))
            ->where('status', OrderConstants::PENDING)
            ->get();

        foreach ($orders as $order) {
            PlacetoPayHelper::statusPayment($order);
            if ($order->status == OrderConstants::APPROVED) {
                event(new OrderApproved($order));
            } 
        }
    }
}
