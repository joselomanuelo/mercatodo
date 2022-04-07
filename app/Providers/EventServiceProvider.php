<?php

namespace App\Providers;

use App\Events\OrderApprovedEvent;
use App\Events\OrderCreatedEvent;
use App\Events\OrderRejectedEvent;
use App\Events\UserDeletedEvent;
use App\Events\UserLogedEvent;
use App\Events\UserLogoutedEvent;
use App\Events\UserUpdatedEvent;
use App\Listeners\AddDeleteToUserLogsTableListener;
use App\Listeners\AddLoginToUsersLogsTableListener;
use App\Listeners\AddLogoutToUsersLogsTableListener;
use App\Listeners\AddUpdateToUserLogsTableListener;
use App\Listeners\OrderApprovedListener;
use App\Listeners\OrderCreatedListener;
use App\Listeners\OrderRejectedListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserLogedEvent::class => [
            AddLoginToUsersLogsTableListener::class,
        ],
        UserLogoutedEvent::class => [
            AddLogoutToUsersLogsTableListener::class,
        ],
        UserUpdatedEvent::class => [
            AddUpdateToUserLogsTableListener::class,
        ],
        UserDeletedEvent::class => [
            AddDeleteToUserLogsTableListener::class,
        ],
        OrderApprovedEvent::class => [
            OrderApprovedListener::class,
        ],
        OrderCreatedEvent::class => [
            OrderCreatedListener::class,
        ],
        OrderRejectedEvent::class => [
            OrderRejectedListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
    }
}
