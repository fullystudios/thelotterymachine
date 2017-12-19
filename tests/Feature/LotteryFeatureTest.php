<?php

namespace Tests\Feature;

use App\Lottery;
use Tests\TestCase;
use App\Participant;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LotteryFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_new_lottery_can_be_created()
    {
        $lottery = make(Lottery::class, ['name' => 'Laravel Lottery']);

        $response = $this->json('post', route('lottery.store'), $lottery->toArray());

        $this->assertEquals(1, Lottery::where('name', 'Laravel Lottery')->count());
    }

    /** @test */
    public function form_has_correct_inputs()
    {
        $response = $this->get(route('lottery.create'));
        $response->assertSee('name="name"');
        $response->assertSee('name="tickets"');
        $response->assertSee('<button type="submit"');
    }

    /** @test */
    public function when_editing_a_lottery_you_can_add_participants__fields_are_seen()
    {
        $lottery = create(Lottery::class);
        $participant = make(Participant::class, ['email' => 'jane@example.com']);
        $response = $this->get($lottery->path('edit'));

        $response->assertSee('name="email"');
        $response->assertSee('button type="submit"');
    }

    /** @test */
    public function lottery_details_are_shown_on_lottery_page()
    {
        $lottery = create(Lottery::class, ['name' => 'Some lottery name that does not exist until now']);
        $participant = make(Participant::class, ['email' => 'jane@example.com']);
        $lottery->addParticipant($participant->toArray());
        $response = $this->get(route('lottery.show', $lottery));

        $editLotteryPath = $lottery->path('edit');
        $response->assertStatus(200);
        $response->assertSee($lottery->name);
        $response->assertSee($participant->email);
        $response->assertSee("<a href=\"{$editLotteryPath}\">Add participant</a>");
    }

    /** @test */
    public function lotteries_page_lists_lotteries()
    {
        $lotteryA = create(Lottery::class, ['name' => 'Super lottery A']);
        $lotteryB = create(Lottery::class, ['name' => 'Super lottery B']);

        $response = $this->get(route('lottery.index'));

        $response->assertStatus(200);
        $response->assertSee($lotteryA->name);
        $response->assertSee($lotteryB->name);
    }

    /** @test */
    public function when_lottery_is_created_corresponding_winning_tickets_are_created()
    {
        $lotteryParams = make(Lottery::class, ['name' => 'Laravel Lottery'])->toArray();
        $lotteryParams['tickets'] = 2;
        $response = $this->json('post', route('lottery.store'), $lotteryParams);

        $this->assertEquals(2, Lottery::where('name', 'Laravel Lottery')->first()->tickets->count());
    }

    /** @test */
    public function participants_can_be_added_in_lottery()
    {
        $participant = make(Participant::class, ['email' => 'jane@example.com']);

        $lottery = create(Lottery::class);

        $lottery->addParticipant($participant->toArray());

        $this->assertCount(1, $lottery->participants);
    }

    /** @test */
    public function can_draw_winner()
    {
        $this->withoutExceptionHandling();
        $lottery = create(Lottery::class);
        $lottery->addTickets(5);
        $lottery->addParticipant(make(Participant::class)->toArray());
        $lottery->addParticipant(make(Participant::class)->toArray());
        $lottery->addParticipant(make(Participant::class)->toArray());
        $response = $this->get(route('participants.draw', ['lottery' => $lottery]));

        $response->assertRedirect(route('lottery.show', ['lottery' => $lottery]));
    }
}
