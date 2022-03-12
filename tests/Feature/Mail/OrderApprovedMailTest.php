<?php

namespace Tests\Feature\Mail;

use App\Mail\Orders\OrderApprovedMail;
use Tests\TestCase;

class OrderApprovedMailTest extends TestCase
{
    public function testOrderApprovedMailContent()
    {
        $mailable = new OrderApprovedMail();

        $mailable->assertSeeInText('Tu orden fue aprobada, tu pedido está en camino.');
        $mailable->assertSeeInHtml('Tu orden fue aprobada, tu pedido está en camino.');
    }
}
