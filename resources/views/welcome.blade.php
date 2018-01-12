@extends('layouts.app')

@section('content')

    <div class="title m-b-md">
        The Lottery Machine!
    </div>

    <div class="links">
        <a href="{{route('lottery.create')}}">Create a lottery</a>
        <a href="{{route('lottery.index')}}">See lotteries</a>
    </div>

@endsection