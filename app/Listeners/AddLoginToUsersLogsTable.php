<?php

namespace App\Listeners;

use App\Events\UserLoged;
use App\Models\User;
use App\Models\UserLog;
use Illuminate\Support\Facades\Log;

class AddLoginToUsersLogsTable
{
    public function __construct()
    {
    }

    public function handle(UserLoged $event): void
    {
        $user = User::where('email', $event->email)
            ->firstOrFail();

        $userLog = new UserLog();
        $userLog->user_id = $user->id;
        $userLog->type = 'login';
        $userLog->save();

        Log::notice('The user with Id '.$user->id.' has logged in.');
    }
}
