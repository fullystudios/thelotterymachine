@extends('layouts.app')
@section('content')
    <h1>{{$lottery->name}}</h1>
    <form action="{{route('participants.store', ['lottery' => $lottery])}}" method="POST">
        {{csrf_field()}}
        <label>Participant email:</label>
        <input type="text" name="email">
        <button type="submit">Submit</button>
    </form>
    <ul>
        @foreach($lottery->participants as $participant)
            <li>{{$participant->email}}</li>
        @endforeach
    </ul>
@endsection