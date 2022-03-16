<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('reference');
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users');
            $table->enum('status', ['PENDING', 'APPROVED', 'REJECTED']);
            $table->bigInteger('price');
            $table->string('process_url')->nullable();
            $table->string('request_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}
