<?php

namespace App\Listeners;

use App\Events\UserDeletedEvent;
use Illuminate\Support\Facades\Log;

class AddDeleteToUserLogsTableListener
{
    public function handle(UserDeletedEvent $event): void
    {
        Log::info('The user with id ' . $event->user->id . ' has been deleted.');
    }
}
