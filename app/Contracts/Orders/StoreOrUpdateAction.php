<?php

namespace App\Contracts\Orders;

use App\Models\Order;
use Illuminate\Http\Request;

abstract class StoreOrUpdateAction
{
    abstract public static function execute(Request $request): Order;
}
