<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <title>{{config('app.name','CCMRS')}}</title>

        
    </head>
    <body class="antialiased">
        @include('layouts.menu')
        <div class="container">
            <div class="jumbotron text-center">
                @yield('content')
                <footer>Ministry of Health Uganda</footer>
            </div>
            
        </div>
        
    </body>
</html>
