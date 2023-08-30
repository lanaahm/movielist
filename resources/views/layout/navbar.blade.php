<!-- NAV -->
<div class="nav-wrapper">
    <div class="container">
        <div class="nav">
            <a href="/" class="logo">
                <i class="main-color"></i>Movie<span class="main-color">List</span>
            </a>
            <ul class="nav-menu" id="nav-menu">
                <li><a href="/">Home</a></li>
                <li><a href="/movie">Movie</a></li>
                <li><a href="/actor">Actor</a></li>
                @auth
                @if (!auth()->user()->is_admin)
                <li><a href="/watchlist">My Watchlist</a></li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/profile/{{ auth()->user()->id }}">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="post" action="/logout">
                                @csrf
                                <button class="dropdown-item" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
                @else
                <li><a class="btn btn-primary" href="/register" role="button">Register</a></li>
                <li><a class="btn btn-outline-primary" href="/login" role="button">Login</a></li>
                @endauth
            </ul>
            <!-- MOBILE MENU TOGGLE -->
            <div class="hamburger-menu" id="hamburger-menu">
                <div class="hamburger"></div>
            </div>
        </div>
    </div>
</div>
<!-- END NAV -->
