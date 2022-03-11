<?php

namespace Tests\Feature\Mail;

use App\Mail\Orders\OrderRejectedMail;
use Tests\TestCase;

class OrderRejectedMailTest extends TestCase
{
    public function testOrderRejectedMailContent()
    {
        $mailable = new OrderRejectedMail();

        $mailable->assertSeeInText('Tu orden fue rechazada o declinada, te invitamos a reintentar el pago.');
        $mailable->assertSeeInHtml('Tu orden fue rechazada o declinada, te invitamos a reintentar el pago.');
    }
}
