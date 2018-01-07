<?php

namespace Tests\Feature;

use App\User;
use App\Lottery;
use Tests\TestCase;
use App\Participant;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WinnerFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_draw_winner()
    {
        $user = create(User::class);
        $lottery = create(Lottery::class, ['creator_id' => $user->id])
            ->addTickets(2);
        $lottery->addParticipant(make(Participant::class)->toArray());
        $lottery->addParticipant(make(Participant::class)->toArray());

        $this->be($user);
        $response = $this->get(route('participants.draw', ['lottery' => $lottery]));

        $response->assertRedirect(route('lottery.show', ['lottery' => $lottery]));
    }

    /** @test */
    public function can_only_draw_winner_if_tickets_are_available()
    {
        $user = create(User::class);
        $lottery = create(Lottery::class, ['creator_id' => $user->id])
            ->addParticipant(make(Participant::class)->toArray());
        // No tickets
        $this->be($user);
        $response = $this->get(route('participants.draw', ['lottery' => $lottery]));

        $response->assertStatus(422);
    }

    /** @test */
    public function can_only_draw_winner_if_participants_are_available()
    {
        $user = create(User::class);
        $lottery = create(Lottery::class, ['creator_id' => $user->id])
            ->addTickets(1);
        // No participants

        $this->be($user);
        $response = $this->get(route('participants.draw', ['lottery' => $lottery]));
        $response->assertStatus(422);
    }
}
