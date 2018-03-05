<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" >

        <title>{{ config('app.name','Company') }}</title>
  </head>
      <nav class="navbar navbar-light " style="background-color: #eef00d;">
              <!-- Navbar content -->
                <h2>Renewal System</h2>
      </nav>
      <div class="container-fluid">
            @yield('content')
      </div>

      <div class="footer-copyright py-3 text-center">
          <div class="container-fluid">
              © 2018 Copyright: <a href="#"> Renewal System </a>
          </div>
      </div>

      <script src="{{ asset('js/jquery-3.3.1.min.js') }}" > </script>
      <script src="{{ asset('js/popper.min.js') }}" > </script>
      <script src="{{ asset('js/bootstrap.min.js') }}" > </script>
</html>
