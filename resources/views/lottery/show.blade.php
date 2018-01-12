@extends('layouts.app')
@section('content')
    <h1>{{$lottery->name}}</h1>
    <h3>Number of winners drawn: {{$lottery->winners->count()}}/{{$lottery->tickets->count()}}</h3>

    <a class="btn btn-primary" href="{{$lottery->path('edit')}}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add participant</a>
    <a class="btn btn-primary" href="{{route('participants.draw', ['lottery' => $lottery])}}"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Draw winner</a>
    <h3>Participants</h3>
    <p>Number of participants: {{$lottery->participants->count()}}</p>

    <ul class="list-group">
        @foreach($lottery->participants as $participant)
            <li class="list-group-item">{{$participant->email}}</li>
        @endforeach
    </ul>
    <h3>Winners</h3>
    <p>Number of winners: {{$lottery->winners->count()}}</p>
    <ul class="list-group">
        @foreach($lottery->winners as $winner)
            <li class="list-group-item winner-animation flex-list flex-list--center"><span style="font-size: 2em; margin-right: 0.4em">🤩</span> {{$winner->email}}</li>
        @endforeach
    </ul>
    

@endsection