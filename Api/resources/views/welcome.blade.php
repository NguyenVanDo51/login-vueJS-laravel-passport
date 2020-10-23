<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Nunito';
        }
    </style>
</head>
<body>
<div id="app">
    <div class="container">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ route('users.index') }}" class="text-sm text-gray-700 underline">User list</a>
                    <div class="my-5">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-info rightButton">Logout</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                    @endif
                @endif
            </div>
        @endif
        <div>Home page</div>
        <ul>
            @foreach($data as $route)
                <li><a href="{{ route($route) }}">{{ $route }}</a></li>

            @endforeach
        </ul>
    </div>
</div>
</body>
</html>
