<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use App\WinningTicket;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WinningTicketUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_winning_ticktes()
    {
        $ticket = new WinningTicket();
        $user = create(User::class);
        $ticket->setWinner($user);
        $this->assertEquals($user->email, $ticket->winner->email);
    }
}
