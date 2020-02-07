<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Styles -->
    @yield('css')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-info">
    <a class="navbar-brand" href={{ route ('home1') }}>Mon blog</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href={{ route ('home1') }}>{{ __('Home') }}</a>
            </li>
            @if(\Illuminate\Support\Facades\Auth::guard('web')->check() || \Illuminate\Support\Facades\Auth::guard('admin')->check())
                <li class="nav-item">
                    <a class="nav-link" href={{ route('posts.index') }}>Posts</a>
                </li>
            @endif
        </ul>
            @auth('admin')
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Administration
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('backend.home') }}">Accueil</a>
                        <a class="dropdown-item" href="{{ route('backend.admins.index') }}">Administrateurs</a>

                        <form class="dropdown-item" action="{{ route('backend.logout') }}" method="post">
                            @csrf
                            <input class="btn btn-danger" type="submit" value="Se déconnecter">
                        </form>
                    </div>
                </div>
                @endauth


            @if (Route::has('login'))
                    @auth
                <div class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }} {{ Auth::user()->first_name }}</a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('account.show' , Auth::user()->id) }}">{{ __('My account') }}</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                </div>
                    @else
                        <ul class="navbar-nav text-light">
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link text-light">{{ __('Register') }}</a>
                                </li>
                            @endif
                        </ul>
                    @endauth
                </div>
            @endif
</nav>
@yield('body')
<footer class="jumbotron text-center">
    <a href="{{ route('backend.home') }}">Administration</a>
</footer>

@yield('js')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>
