<?php

namespace Tests\Feature\Listeners;

use App\Events\OrderRejectedEvent;
use App\Listeners\OrderRejectedListener;
use App\Mail\Orders\OrderRejectedMail;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class OrderRejectedListenerTest extends TestCase
{
    use RefreshDatabase;

    public function testOrderApproved(): void
    {
        Mail::fake();

        //$this->seed(OrderSeeder::class);

        User::factory()
            ->has(Order::factory())
            ->create([
                'id' => 1,
            ]);

        $order = Order::first();

        $event = new OrderRejectedEvent($order);
        $listener = new OrderRejectedListener($event);

        $listener->handle($event);

        Mail::assertQueued(OrderRejectedMail::class);
    }

    public function testListenerIsAttachedToEvent()
    {
        Event::fake();
        Event::assertListening(
            OrderRejectedEvent::class,
            OrderRejectedListener::class
        );
    }
}
