<?php

namespace App\Http\Controllers;

use App\Lottery;
use Illuminate\Http\Request;

class LotteryController extends Controller
{
    public function create()
    {
        return view('lottery.create');
    }

    public function store(Request $request)
    {
        $lottery = Lottery::create($request->all());
        return redirect()->route('lottery.show', [$lottery]);
    }

    public function show()
    {
        return view('lottery.show');
    }
}
