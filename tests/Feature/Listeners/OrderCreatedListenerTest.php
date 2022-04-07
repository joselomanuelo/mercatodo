<?php

namespace Tests\Feature\Listeners;

use App\Events\OrderCreatedEvent;
use App\Listeners\OrderCreatedListener;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class OrderCreatedListenerTest extends TestCase
{
    use RefreshDatabase;

    public function testListenerIsAttachedToEvent()
    {
        Event::fake();
        Event::assertListening(
            OrderCreatedEvent::class,
            OrderCreatedListener::class
        );
    }
}
