<?php

namespace App\Mail\Orders;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderApprovedMail extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    public function build(): self
    {
        return $this->markdown('mail.orders.approved');
    }
}
