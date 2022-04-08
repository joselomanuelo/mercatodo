<?php

namespace App\Listeners;

use App\Actions\Users\UserAddInputLogsContract;
use App\Events\UserLogoutedEvent;
use Illuminate\Support\Facades\Log;

class AddLogoutToUsersLogsTableListener
{
    public function handle(UserLogoutedEvent $event): void
    {
        UserAddInputLogsContract::execute($event->user, 'logout');

        Log::info('The user with Id ' . $event->user->id . ' has logged out.');
    }
}
