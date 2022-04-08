<?php

namespace App\Jobs;

use App\Constants\OrderConstants;
use App\Helpers\PlacetoPayHelper;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckPendingOrdersJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function handle(): void
    {
        $orders = Order::whereDate('created_at', '>=', now()->subHours(OrderConstants::DURATION + 1))
            ->where('status', OrderConstants::PENDING)
            ->get();

        foreach ($orders as $order) {
            PlacetoPayHelper::statusPayment($order);
        }
    }
}
