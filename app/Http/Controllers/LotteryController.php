<?php

namespace App\Http\Controllers;

use App\Lottery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LotteryController extends Controller
{
    public function index()
    {
        $lotteries = Lottery::where('creator_id', \Auth::id())->get();
        return view('lottery.index', compact('lotteries'));
    }

    public function create()
    {
        if (Auth::check()) {
            return view('lottery.create');
        }
        abort(404);
    }

    public function store(Request $request)
    {
        $lottery = Lottery::create($request->all());
        $lottery->creator_id = \Auth::id();
        $lottery->save();

        $lottery->addTickets($request->tickets);
        return redirect()->route('lottery.show', [$lottery]);
    }

    public function show(Lottery $lottery)
    {
        return view('lottery.show', compact('lottery'));
    }

    public function edit(Lottery $lottery)
    {
        return view('lottery.edit', compact('lottery'));
    }
}
