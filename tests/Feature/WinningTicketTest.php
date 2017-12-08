<?php 

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;

class WinningTicketTest
{
    use DatabaseMigrations;

    /** @test */
    public function a_ticket_can_get_a_winner()
    {
        $ticket = new WinningTicket();
    }
}
