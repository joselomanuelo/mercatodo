<?php

namespace App\Listeners;

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
        $userLog = new UserLog();
        $userLog->user_id = $event->user->id;
        $userLog->type = 'logout';
        $userLog->save();

        Log::notice('The user with Id '.$event->user->id.' has logged out.');
    }
}
