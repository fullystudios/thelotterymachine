<?php

namespace Tests\Feature;

use App\User;
use App\Lottery;
use Tests\TestCase;
use App\Participant;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LotteryFeatureTest extends TestCase
{
    use RefreshDatabase;

    private function lotteryParams(array $overrides = [])
    {
        $params = make(Lottery::class, ['name' => 'Laravel Lotterty'])->toArray();
        $params['tickets'] = 2;

        $params = array_merge($params, $overrides);
        return $params;
    }

    /** @test */
    public function a_logged_in_user_can_visit_create_lottery_form()
    {
        $this->be(create(User::class));

        $response = $this->get('lottery/create');

        $response->assertStatus(200);
    }

    /** @test */
    public function a_logged_in_user_can_create_a_lottery()
    {
        $lottery = $this->lotteryParams();
        $user = create(User::class);
        $this->be($user);

        $response = $this->json('post', route('lottery.store'), $lottery);
        $this->assertEquals(1, Lottery::where('creator_id', $user->id)->count());
    }

    /** @test */
    public function a_logged_out_user_cannot_create_a_lottery()
    {
        $lottery = $this->lotteryParams();

        $response = $this->get(route('lottery.create'));
        $response->assertStatus(302);

        $response = $this->json('post', route('lottery.store'), $lottery);

        $this->assertEquals(0, Lottery::where('name', 'Laravel Lottery')->count());
    }

    /** @test */
    public function create_lottery_form_has_correct_inputs()
    {
        $this->be(create(User::class));
        $response = $this->get(route('lottery.create'));
        $response->assertSee('name="name"');
        $response->assertSee('name="tickets"');
        $response->assertSee('<button type="submit"');
    }

    /** @test */
    public function lottery_details_are_shown_on_lottery_page()
    {
        $user = create(User::class);
        $participant = make(Participant::class, ['email' => 'jane@example.com']);
        $lottery = create(Lottery::class, ['creator_id' => $user->id])->addParticipant($participant->toArray());

        $this->be($user);
        $response = $this->get(route('lottery.show', $lottery));

        $editLotteryPath = $lottery->path('edit');
        $response->assertStatus(200);
        $response->assertSee($lottery->name);
        $response->assertSee($participant->email);
    }

    /** @test */
    public function lotteries_page_lists_lottery_creators_lotteries()
    {
        $user = create(User::class);
        $lotteryA = create(Lottery::class, ['name' => 'Super lottery A', 'creator_id' => $user->id]);
        $lotteryB = create(Lottery::class, ['name' => 'Super lottery B', 'creator_id' => $user->id]);
        $lotteryC = create(Lottery::class, ['name' => 'Super lottery C', 'creator_id' => $user->id + 1]);

        $this->be($user);
        $response = $this->get(route('lottery.index'));

        $response->assertStatus(200);
        $response->assertSee($lotteryA->name);
        $response->assertSee($lotteryB->name);
        $response->assertDontSee($lotteryC->name);
    }

    /** @test */
    public function when_lottery_is_created_corresponding_winning_tickets_are_created()
    {
        $this->be(create(User::class));
        $lotteryParams = make(Lottery::class, ['name' => 'Laravel Lottery'])->toArray();
        $lotteryParams['tickets'] = 2;
        $response = $this->json('post', route('lottery.store'), $lotteryParams);

        $this->assertEquals(2, Lottery::where('name', 'Laravel Lottery')->first()->tickets->count());
    }
}
