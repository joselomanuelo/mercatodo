<?php

namespace Tests\Feature\Listeners;

use App\Events\OrderApprovedEvent;
use App\Listeners\OrderApprovedListener;
use App\Mail\Orders\OrderApprovedMail;
use App\Models\Order;
use App\Models\User;
use Database\Seeders\OrderSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class OrderApprovedListenerTest extends TestCase
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

        $event = new OrderApprovedEvent($order);
        $listener = new OrderApprovedListener($event);

        $listener->handle($event);

        Mail::assertSent(OrderApprovedMail::class);
    }

    public function testListenerIsAttachedToEvent()
    {
        Event::fake();
        Event::assertListening(
            OrderApprovedEvent::class,
            OrderApprovedListener::class
        );
    }
}
