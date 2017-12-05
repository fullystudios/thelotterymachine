<?php

namespace App\Http\Controllers;

use App\Lottery;
use Illuminate\Http\Request;

class LotteryController extends Controller
{
    public function store(Request $request)
    {
        $lottery = Lottery::create($request->all());
        return redirect()->route('lottery.show', [$lottery]);
    }
}
