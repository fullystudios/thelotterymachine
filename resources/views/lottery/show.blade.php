@extends('layouts.app')
@section('content')
    <h1>{{$lottery->name}}</h1>
    <a href="{{$lottery->path('edit')}}">Add participant</a>
    <ul>
        @foreach($lottery->participants as $participant)
            <li>{{$participant->email}}</li>
        @endforeach
    </ul>
@endsection