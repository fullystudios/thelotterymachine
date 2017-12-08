<?php

namespace App\Http\Controllers;

use App\Lottery;
use Illuminate\Http\Request;

class LotteryController extends Controller
{
    public function index()
    {
        $lotteries = Lottery::all();
        return view('lottery.index', compact('lotteries'));
    }

    public function create()
    {
        return view('lottery.create');
    }

    public function store(Request $request)
    {
        $lottery = Lottery::create($request->all());
        $lottery->addTickets($request->tickets);
        return redirect()->route('lottery.show', [$lottery]);
    }

    public function show(Lottery $lottery)
    {
        return view('lottery.show', compact('lottery'));
    }
}
