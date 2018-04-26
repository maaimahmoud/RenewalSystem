<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('layouts.head')
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
                                        All Clients
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
                                            All Services
                                        </a>

                                        <a class="dropdown-item" href="/servicescategories">
                                            Categories
                                        </a>

                                    </div>
                            </li>

                            <li><a class="nav-link" href="/paymentmethods">Payment Methods</a></li>

                            <li><a class="nav-link" href="/statistics">Statistics</a></li>
                            <li><a class="nav-link" href="#" data-toggle="collapse" data-target=".search-input" id="searchbutton">Search</a></li>

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
                <form class="row" id="searchform" method="get" action="{{url('/search/client')}}">
                    <input type="text" name="search" class="search form-control" placeholder="Search">
                  </form>
                </div>
        <main class="py-4 container-fluid er-fluid full-height">
            @include('messages')
            @yield('content')
        </main>

        <div class="footer-copyright py-3 text-center">
            <div class="container-fluid">
                © 2018 Copyright: <a href="/"> Renewal System </a>
            </div>
        </div>

    </div>

  </body>
  <div class="se-pre-con"></div>




</body>
</html>
