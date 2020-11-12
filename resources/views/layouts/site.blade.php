<!DOCTYPE html>
<html lang='{{ str_replace("_", "-", app()->getLocale()) }}'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <meta http-equiv='X-UA-Compatible' content='ie=edge'>
    <meta name='csrf-token' content='{{ csrf_token() }}'>
    <title>Game Archive</title>
    <link rel='stylesheet' href='/css/app.css'>
    @yield('styles')
</head>

<body>
    <div id='app'>
        <nav-bar :user='@json(Auth::user())'></nav-bar>
        <form id='logout-form' action='{{ route("logout") }}' method='POST' style='display: none;'>
            @csrf
        </form>
        <b-overlay :show='showLoadingOverlay' rounded='false' variant='dark' spinner-variant='light'>
            <b-container fluid>
                <b-row class='full-height scrolled-y'>
                    <b-col class='h-100'>
                        <b-container class='py-3 h-100'>
                            @yield('content')
                        </b-container>
                    </b-col>
                </b-row>
            </b-container>
        </b-overlay>
        <footer-bar></footer-bar>
        <flash-message></flash-message>
        @yield('modals')
    </div>
    <script src='/js/app.js'></script>
    @yield('scripts')
</body>

</html>
