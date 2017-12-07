@extends('layouts.app')
@section('content')
    @foreach($lotteries as $lottery)
        <li>{{$lottery->name}} <a href="{{$lottery->path()}}">Show</a></li>
    @endforeach
@endsection