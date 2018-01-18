<?php

namespace Tests\Feature;

use App\User;
use App\Lottery;
use Tests\TestCase;
use App\Participant;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipantFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function when_editing_a_lottery_you_can_add_participants_fields_are_seen()
    {
        $user = create(User::class);
        $lottery = create(Lottery::class, ['creator_id' => $user->id]);
        $participant = make(Participant::class, ['email' => 'jane@example.com']);

        $this->be($user);
        $response = $this->get($lottery->path('edit'));

        $response->assertSee('name="email"');
        $response->assertSee('type="submit"');
    }

    /** @test */
    public function participants_can_be_added_in_lottery()
    {
        $participant = make(Participant::class, ['email' => 'jane@example.com']);

        $lottery = create(Lottery::class);

        $lottery->addParticipant($participant->toArray());

        $this->assertCount(1, $lottery->participants);
    }
}
