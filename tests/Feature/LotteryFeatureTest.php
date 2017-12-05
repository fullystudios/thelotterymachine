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
}
