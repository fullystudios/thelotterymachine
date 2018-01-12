@extends('layouts.app')

@section('content')

<h3>{{ $exception->getMessage() }}</h3>
<h1 class="m-b-lg">😢</h1>

<a class="btn btn-primary" href="{{route('lottery.index')}}">See all lotteries</a>

@endsection
