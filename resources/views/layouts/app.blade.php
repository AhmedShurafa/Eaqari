<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("assets/css/all.css")}}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset("assets/css/bootstrap.css")}}">

    {{--lightbox--}}
    <link rel="stylesheet" href="{{asset("assets/css/lightbox.min.css")}}">

    <!-- Custom -->
    <link rel="stylesheet" href="{{asset("assets/css/style.css")}}">

    <!-- style ar  -->
    <link rel="stylesheet" href="{{asset("assets/css/style_ar.css")}}">
</head>
<body>
    <div id="app">

        <main class="">
            @yield('content')
        </main>
    </div>
    <script src="{{asset("assets/js/jquery-3.3.1.min.js")}}"></script>
{{--    <script src="{{asset("assets/js/bootstrap.bundle.min.js")}}"></script>--}}
    <script src="{{asset("assets/js/lightbox.min.js")}}"></script>
    <script src="{{asset("assets/js/main.js")}}"></script>
</body>
</html>
