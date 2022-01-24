<?php

namespace App\Listeners;

use App\Actions\Users\AddInputUserLogs;
use App\Events\UserDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class AddDeleteToUserLogsTable
{
    
    public function __construct()
    {
    
    }

    
    public function handle(UserDeleted $event):void 
    {
        AddInputUserLogs::execute($event->user, 'delete');

        Log::notice('The user with id ' . $event->user->id . ' has been deleted.');
    }
}
