<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $order = Order::factory()->create();

        OrderProduct::factory()
            ->has(Product::factory())
            ->for($order)
            ->create();

        OrderProduct::factory()
            ->has(Product::factory())
            ->for($order)
            ->create();
    }
}
