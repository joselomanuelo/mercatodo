<?php

namespace App\Listeners;

use App\Actions\Users\UserAddInputLogsContract;
use App\Events\UserLogedEvent;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AddLoginToUsersLogsTableListener
{
    public function handle(UserLogedEvent $event): void
    {
        $user = User::where('email', $event->email)
            ->firstOrFail();

        UserAddInputLogsContract::execute($user, 'login');

        Log::info('The user with Id ' . $user->id . ' has logged in.');
    }
}
