<?php

namespace App\Listeners;

use App\Actions\Users\AddInputUserLogs;
use App\Events\UserLoged;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AddLoginToUsersLogsTable
{
    public function handle(UserLoged $event): void
    {
        $user = User::where('email', $event->email)
            ->firstOrFail();

        AddInputUserLogs::execute($user, 'login');

        Log::info('The user with Id ' . $user->id . ' has logged in.');
    }
}
