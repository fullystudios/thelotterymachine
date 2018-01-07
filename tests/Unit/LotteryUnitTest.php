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
        $this->assertEquals($lottery->tickets()->count(), 2);
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
        $participant = make(Participant::class, ['email' => 'jane@example.com']);
        $lottery = create(Lottery::class)
            ->addTickets(2)
            ->addParticipant($participant->toArray());

        $lottery->drawWinner();
        $lottery->load('availableTickets');
        $this->assertEquals($lottery->winners->first()->email, 'jane@example.com');
        $this->assertCount(1, $lottery->availableTickets);
    }

    /** @test */
    public function cannot_draw_a_winner_if_no_tickets_are_available()
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

    /** @test */
    public function gets_share_key_on_save()
    {
        $lottery = create(Lottery::class);
        
        $lottery->fresh();

        $this->assertNotNull($lottery->share_key);
    }
}
