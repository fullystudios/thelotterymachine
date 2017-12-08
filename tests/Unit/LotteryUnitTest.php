<?php

namespace Tests\Unit;

use App\Lottery;
use Tests\TestCase;
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
}
