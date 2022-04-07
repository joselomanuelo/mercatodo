<?php

namespace App\Listeners;

use App\Actions\Users\AddInputUserLogs;
use App\Events\UserUpdatedEvent;
use Illuminate\Support\Facades\Log;

class AddUpdateToUserLogsTableListener
{
    public function handle(UserUpdatedEvent $event): void
    {
        AddInputUserLogs::execute($event->user, 'update');

        Log::info('The user with id ' . $event->user->id . ' has been updated.');
    }
}
