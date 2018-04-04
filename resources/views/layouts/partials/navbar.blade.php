<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ to('welcome') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li><a class="nav-link {{ set_active('wines/all') }}" href="{{ to('wines.index') }}">Browse</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li><a class="nav-link {{ set_active('login') }}" href="{{ to('login') }}">Login</a></li>
                    <li><a class="nav-link {{ set_active('register') }}" href="{{ to('register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <img src="{{ asset(Auth::user()->thumbnail_avatar) }}"> {{ Auth::user()->first_name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item {{ set_active('user/@' . Auth::user()->username) }}"
                               href="{{ to('user.profile.show', Auth::user()) }}"
                            >My Profile</a>

                            {{--Dropdown divider--}}
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="{{ to('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ to('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>