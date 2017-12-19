@extends('layouts.app')
@section('content')
    <h1>{{$lottery->name}}</h1>
    <h3>Number of winners drawn: {{$lottery->winners->count()}}/{{$lottery->tickets->count()}}</h3>

    <a href="{{$lottery->path('edit')}}">Add participant</a>
    <a href="{{route('participants.draw', ['lottery' => $lottery])}}">Draw winner</a>
    <ul>
        @foreach($lottery->participants as $participant)
            <li>{{$participant->email}}</li>
        @endforeach
    </ul>
    <ul>
        @foreach($lottery->winners as $winner)
            <li>{{$winner->email}}</li>
        @endforeach
    </ul>

@endsection