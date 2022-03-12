<?php

namespace Tests\Feature\Listeners;

use App\Events\OrderCreated;
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
            OrderCreated::class,
            OrderCreatedListener::class
        );
    }
}
