<?php

namespace App\Console\Commands;

use App\Jobs\CheckPendingOrdersJob;
use Illuminate\Console\Command;

class CheckPendingOrdersCommand extends Command
{
    protected $signature = 'orders:pending';

    protected $description = 'Check pendings orders';

    public function handle()
    {
        dispatch(new CheckPendingOrdersJob());
    }
}
