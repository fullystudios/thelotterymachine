<?php

namespace App\Http\Controllers;

use App\Lottery;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function store(Request $request, Lottery $lottery)
    {
        $lottery->addParticipant($request->all());
        return redirect()->route('lottery.show', ['lottery' => $lottery]);
    }

    public function draw(Request $request, Lottery $lottery)
    {
        $lottery->drawWinner();
        return redirect()->route('lottery.show', ['lottery' => $lottery]);
    }
}
