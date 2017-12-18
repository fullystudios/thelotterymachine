<?php 

namespace Tests\Feature;

use Tests\TestCase;
use App\Participant;
use App\WinningTicket;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WinningTicketUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_assign_a_winner()
    {
        $ticket = create(WinningTicket::class);
        $participant = create(Participant::class);

        $ticket->assignWinner($participant);
        $ticket->fresh();
        $winnerId = $ticket->winner->id;
        $participantId = $participant->id;

        $this->assertEquals($winnerId, $participantId);
    }
}
