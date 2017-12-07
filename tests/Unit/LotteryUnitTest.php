<?php

namespace Tests\Unit;

use App\Lottery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function show_path_is_returned()
    {
        // Path helper, not sure if it should be tested.
        $lottery = create(Lottery::class);
        
        $this->assertTrue(str_contains("lottery/{$lottery->id}"))
    }
}
