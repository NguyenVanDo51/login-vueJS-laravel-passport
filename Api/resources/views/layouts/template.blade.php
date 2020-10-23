<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack('scripts')

</head>
<body class="font-sans antialiased">

    <div class="container">
        @auth()
            <div class="mb-5 mt-1">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <span class="mr-2">Hello, {{ Auth::user()->name }}  </span>
                    <button class="btn btn-info rightButton">Logout</button>
                </form>
            </div>
        @endauth
        @yield('content')
    </div>


</body>
</html>
