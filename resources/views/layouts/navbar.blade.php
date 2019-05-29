<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand fas fa-archive" href="{{ url('/index') }}"></a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav-bar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/index') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/add') }}">Add/Update</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/queries') }}">Queries</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/charts') }}">Charts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/about') }}">About</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            @auth
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/home') }}">Home</a>
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
