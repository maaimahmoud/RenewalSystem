<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
    .sub-list{
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        grid-gap: 10px;
        padding: 10px;
        overflow-y: auto;
    }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                        @else

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Clients <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/clients/create">
                                        Add Client
                                    </a>

                                    <a class="dropdown-item" href="/clients">
                                        View All
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Services <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="/services/create">
                                            Add Service
                                        </a>

                                        <a class="dropdown-item" href="/services">
                                            View All Services
                                        </a>

                                        <a class="dropdown-item" href="/clients">
                                            Add Category
                                        </a>

                                        <a class="dropdown-item" href="/servicescategories">
                                            View All Categories
                                        </a>

                                    </div>
                            </li>

                            <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Payment Methods <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="/clients/create">
                                            Add Payment Method
                                        </a>

                                        <a class="dropdown-item" href="/paymentmethods">
                                            View All
                                        </a>
                                    </div>
                            </li>

                            <li><a class="nav-link" href="#">Statistics</a></li>
                            <li><a class="nav-link" href="/settings">Settings</a></li>
                            <li><a class="nav-link" href="/settings" data-toggle="collapse" data-target=".search-input">Search</a></li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container collapse search-input searchbar">
                <form class="row" id="demo-2" method="get" action="{{url('/search/client')}}">
                    <input type="text" name="search" class="search form-control" placeholder="Search">
                  </form>
                </div>
        <main class="py-4 contain er-fluid full-height">
            @include('messages')
            @yield('content')
        </main>

        <div class="footer-copyright py-3 text-center">
            <div class="container-fluid">
                © 2018 Copyright: <a href="#"> Renewal System </a>
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{ asset('js/layout.js') }}"></script>

</body>
</html>
