<?php 

namespace Tests\Feature;

use App\Ticket;
use Tests\TestCase;
use App\Participant;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_assign_a_winner()
    {
        $ticket = create(Ticket::class);
        $participant = create(Participant::class);

        $ticket->assignWinner($participant);
        $ticket->fresh();
        $winnerId = $ticket->winner->id;
        $participantId = $participant->id;

        $this->assertEquals($winnerId, $participantId);
    }
}
