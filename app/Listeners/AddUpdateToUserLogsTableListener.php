<?php

namespace App\Listeners;

use App\Actions\Users\UserAddInputLogsContract;
use App\Events\UserUpdatedEvent;
use Illuminate\Support\Facades\Log;

class AddUpdateToUserLogsTableListener
{
    public function handle(UserUpdatedEvent $event): void
    {
        UserAddInputLogsContract::execute($event->user, 'update');

        Log::info('The user with id ' . $event->user->id . ' has been updated.');
    }
}
