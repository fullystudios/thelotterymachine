@extends('layouts.app')
@section('content')
    <h1 class="m-b-md"><small>Add participant to lottery:</small><br>{{$lottery->name}}</h1>
    <form class="m-b-lg" action="{{route('participants.store', ['lottery' => $lottery])}}" method="POST">
        {{csrf_field()}}
        <div class="form-group">
            <label>Participant email:</label>
            <input class="form-control" type="text" name="email">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

    <ul class="list-group">
        <h3>Current participants</h3>
        <p>Number of participants: {{$lottery->participants->count()}}</p>
        @foreach($lottery->participants as $participant)
            <li class="list-group-item">{{$participant->email}}</li>
        @endforeach
    </ul>
@endsection