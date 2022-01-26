<?php

namespace App\Providers;

use App\Events\UserDeleted;
use App\Events\UserLoged;
use App\Events\UserLogouted;
use App\Events\UserUpdated;
use App\Listeners\AddDeleteToUserLogsTable;
use App\Listeners\AddLoginToUsersLogsTable;
use App\Listeners\AddLogoutToUsersLogsTable;
use App\Listeners\AddUpdateToUserLogsTable;
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
        UserLoged::class => [
            AddLoginToUsersLogsTable::class,
        ],
        UserLogouted::class => [
            AddLogoutToUsersLogsTable::class,
        ],
        UserUpdated::class => [
            AddUpdateToUserLogsTable::class,
        ],
        UserDeleted::class => [
            AddDeleteToUserLogsTable::class,
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
