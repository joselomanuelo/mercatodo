<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserLoged
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }
}
