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
        $response->assertSee('<button type="submit"');
    }

    /** @test */
    public function lottery_details_are_shown_on_lottery_page()
    {
        $lottery = create(Lottery::class, ['name' => 'Some lottery name that does not exist until now']);

        $response = $this->get(route('lottery.show', $lottery));

        $response->assertSee($lottery->name);
    }
}
