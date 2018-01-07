@extends('layouts.app')
@section('content')
    <h2>Hi {{\Auth::user()->name}}</h2>
    <h3>Here are your lotteries</h3>
    <ul>
        @foreach($lotteries as $lottery)
            <li>{{$lottery->name}} <a href="{{$lottery->path()}}">Show</a></li>
        @endforeach
    </ul>
@endsection