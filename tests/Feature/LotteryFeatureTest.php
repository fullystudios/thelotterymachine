<?php

namespace Tests\Feature;

use App\Lottery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
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
    public function lottery_details_are_shown_on_lottery_page()
    {
        $lottery = create(Lottery::class, ['name' => 'Some lottery name that does not exist until now']);

        $response = $this->get(route('lottery.show', $lottery));

        $response->assertStatus(200);
        $response->assertSee($lottery->name);
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

        $this->assertEquals(2, Lottery::where('name', 'Laravel Lottery')->first()->winningTickets->count());
    }
}
