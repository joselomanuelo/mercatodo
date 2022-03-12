<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    public function up(): void
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                ->constrained('orders')
                ->nullable();
            $table->foreignId('product_id')
                ->constrained('products')
                ->nullable();
            $table->foreignId('user_id')
                ->constrained('users')
                ->nullable();
            $table->bigInteger('amount');
            $table->bigInteger('price');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
}
