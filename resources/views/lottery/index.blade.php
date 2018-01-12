@extends('layouts.app')
@section('content')
    <h2>Hi {{\Auth::user()->name}}</h2>
    <h3>Here are your lotteries</h3>
    <ul class="list-group">
        @foreach($lotteries as $lottery)
            <li class="list-group-item flex-list"><span class="flex-list__first">{{$lottery->name}}</span> <a class="btn btn-primary flex-list__last" href="{{$lottery->path()}}"><i class="glyphicon glyphicon-eye-open"></i> View</a></li>
        @endforeach
    </ul>
@endsection