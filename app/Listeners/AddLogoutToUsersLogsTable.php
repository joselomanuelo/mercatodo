<?php

namespace App\Listeners;

use App\Actions\Users\AddInputUserLogs;
use App\Events\UserLogouted;
use Illuminate\Support\Facades\Log;

class AddLogoutToUsersLogsTable
{
    public function handle(UserLogouted $event): void
    {
        AddInputUserLogs::execute($event->user, 'logout');

        Log::info('The user with Id ' . $event->user->id . ' has logged out.');
    }
}
