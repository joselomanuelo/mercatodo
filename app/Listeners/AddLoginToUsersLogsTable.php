<?php

namespace App\Listeners;

use App\Actions\Users\AddInputUserLogs;
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

        AddInputUserLogs::execute($user, 'login');

        Log::notice('The user with Id '.$user->id.' has logged in.');
    }
}
