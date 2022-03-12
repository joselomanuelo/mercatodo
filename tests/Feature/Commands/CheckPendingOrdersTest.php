<?php

namespace Tests\Feature\Commands;

use Tests\TestCase;

class CheckPendingOrdersTest extends TestCase
{
    public function testCommand(): void
    {
        $command = $this->artisan('orders:pending');

        $command->assertSuccessful();
    }
}
