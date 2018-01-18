<?php

namespace App\Http\Controllers;

use App\Lottery;
use Illuminate\Http\Request;
use App\Exceptions\NotEnoughTicketsException;
use App\Exceptions\NotEnoughParticipantsException;

class ParticipantController extends Controller
{
    public function store(Request $request, Lottery $lottery)
    {
        $lottery->addParticipant($request->all());
        return redirect()->route('lottery.show', ['lottery' => $lottery]);
    }

    public function draw(Request $request, Lottery $lottery)
    {
        try {
            $lottery->drawWinner();
            return redirect()->route('lottery.show', ['lottery' => $lottery]);
        } catch (NotEnoughTicketsException $e) {
            abort(422, 'Not enough tickets');
        } catch (NotEnoughParticipantsException $e) {
            abort(422, 'Not enough participants');
            return response()->json(['Not enough participants'], 422);
        }
    }
}
