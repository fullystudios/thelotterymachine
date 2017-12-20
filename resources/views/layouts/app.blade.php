<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

        <title>The Laravel Lottery Machine - @yield('title')</title>

    </head>
    <body>
        <header>
            <h1><a href="{{route('home')}}">The lottery machine</a></h1>
        </header>
        @yield('content')
    </body>
</html>
