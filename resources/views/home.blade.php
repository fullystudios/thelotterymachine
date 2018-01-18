@extends('layouts.app')

@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    You are logged in!
    <div class="title m-b-md">
        The Lottery Machine!
    </div>

    <div class="links">
        <a href="{{route('lottery.create')}}">Create a lottery</a>
        <a href="{{route('lottery.index')}}">See lotteries</a>
    </div>

@endsection
