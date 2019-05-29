<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>The Archive</title>
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>
    @include('layouts.navbar')
    <div id="app" class="container-fluid">
        @yield('content')
    </div>
    @include('layouts.footer')
    <script src="/js/app.js"></script>
</body>
</html>