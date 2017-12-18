<?php

namespace Tests\Unit;

use App\Lottery;
use Tests\TestCase;
use App\Participant;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LotteryUnitTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_winning_ticktes()
    {
        $lottery = create(Lottery::class);
        $lottery->addTickets(2);
        $this->assertEquals($lottery->winningTickets()->count(), 2);
    }

    /** @test */
    public function can_get_number_of_free_winning_tickets()
    {
        $lottery = create(Lottery::class);

        $lottery->addTickets(2);

        $this->assertCount(2, $lottery->availableTickets);
    }

    /** @test */
    public function can_draw_a_winner_for_a_ticket()
    {
        $lottery = create(Lottery::class);
        $participant = make(Participant::class, ['email' => 'jane@example.com']);
        $lottery->addParticipant($participant->toArray());
        $lottery->addTickets(2);

        $lottery->drawWinner();
        $lottery->load('availableTickets');
        $this->assertEquals($lottery->winners->first()->email, 'jane@example.com');
        $this->assertCount(1, $lottery->availableTickets);
    }
}
