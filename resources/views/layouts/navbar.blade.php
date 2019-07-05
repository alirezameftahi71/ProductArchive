<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand fas fa-archive" href="{{ url('/') }}"></a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav-bar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/create') }}">Create</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            @auth
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">Home</a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i>&nbsp;Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus"></i>&nbsp;Register</a>
            </li>
            @endauth
        </ul>
    </div>
</nav>
