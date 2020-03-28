<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Game Archive</title>
    <link rel="stylesheet" href="/css/app.css">
    @yield('styles')
</head>

<body>
    <div id="app">
        <navigationbar></navigationbar>
        <div class="container-fluid">
            @yield('content')
        </div>
        <footbar></footbar>
        <div class="loader loader-default" data-text data-blink></div>
        @yield('modals')
    </div>
    <script src="/js/app.js"></script>
    @yield('scripts')
</body>

</html>
