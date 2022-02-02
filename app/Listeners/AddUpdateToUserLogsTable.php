<?php

namespace App\Listeners;

use App\Actions\Users\AddInputUserLogs;
use App\Events\UserUpdated;
use Illuminate\Support\Facades\Log;

class AddUpdateToUserLogsTable
{
    public function handle(UserUpdated $event): void
    {
        AddInputUserLogs::execute($event->user, 'update');

        Log::info('The user with id '.$event->user->id.' has been updated.');
    }
}
