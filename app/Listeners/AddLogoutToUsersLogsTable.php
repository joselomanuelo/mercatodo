<?php

namespace App\Listeners;

use App\Actions\Users\AddInputUserLogs;
use App\Events\UserLogouted;
use App\Models\UserLog;
use Illuminate\Support\Facades\Log;

class AddLogoutToUsersLogsTable
{
    public function __construct()
    {
    }

    public function handle(UserLogouted $event): void
    {
        AddInputUserLogs::execute($event->user, 'logout');

        Log::notice('The user with Id '.$event->user->id.' has logged out.');
    }
}
