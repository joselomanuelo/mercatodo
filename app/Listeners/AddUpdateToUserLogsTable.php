<?php

namespace App\Listeners;

use App\Actions\Users\AddInputUserLogs;
use App\Events\UserUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class AddUpdateToUserLogsTable
{
    
    public function __construct()
    {
        //
    }

    
    public function handle(UserUpdated $event): void
    {
        AddInputUserLogs::execute($event->user, 'update');

        Log::notice('The user with id ' . $event->user->id . ' has been updated.');
    }
}
