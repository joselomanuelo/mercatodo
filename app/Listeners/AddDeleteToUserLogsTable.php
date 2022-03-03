<?php

namespace App\Listeners;

use App\Events\UserDeleted;
use Illuminate\Support\Facades\Log;

class AddDeleteToUserLogsTable
{
    public function handle(UserDeleted $event): void
    {
        Log::info('The user with id ' . $event->user->id . ' has been deleted.');
    }
}
