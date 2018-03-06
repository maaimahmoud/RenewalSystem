<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" >

        <style type="text/css">
            :root {
                --main-color: #bbbbbb;
                }
              .navbar{
                background-color: var(--main-color);
                margin-bottom: 55px;
              }
              .btn{
                background-color: var(--main-color);
              }
              .footer-copyright{
                background-color: var(--main-color);
                margin-top: 20px;
              }
              .navbar-dropdowns{
                margin-right: 5%;
              }
              .navbar-dropdowns div{
                margin-right: 85px;
              }
              .navbar-dropdowns div a{
                width:150%;
                color:black;
              }

              .sub-list{
                  display: grid;
                  grid-template-columns: repeat(6, 1fr);
                  grid-gap: 10px;
                  padding: 10px;
                  overflow-y: auto;
              }

        </style>

        <title>{{ config('app.name','Company') }}</title>
  </head>
      <nav class="navbar navbar-light" style="height:90px">
              <!-- Navbar content -->
              <a href="/"><img src="/images/company-logo.png" alt="Company logo" style=" max-width:130px; position: absolute; top: 15px; left: 50px;"></a>
              <div class="row navbar-dropdowns">
            <div class="dropdown show">
            <a class="btn btn-lg dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Service
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="/services">View All</a>

            </div>
          </div>
          <div class="dropdown show">
  <a class="btn btn-lg dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Client
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="/clients">View All</a>
  </div>
</div>
<div class="dropdown show">
  <a class="btn btn-lg" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Statistics
  </a>
</div>
<div class="dropdown show">
  <a class="btn btn-lg" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Settings
  </a>
</div>
</div>
      </nav>

      <div class="contain er-fluid">
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
      <script>
      $(".full-height").css({
              "min-height": $(window).height() - $(".footer-copyright").innerHeight() - $("nav").innerHeight()
          });
          $(window).on('resize', function() {
              $(".full-height").css({
                "min-height": $(window).height() - $(".footer-copyright").innerHeight() - $("nav").innerHeight()
          });
      });

      $(document).ready(function () {
      //your code here
      $('#html5colorpicker').change(function() {
              console.log('hi i was called');
              var newcolor = $('#html5colorpicker').val();
              document.body.style.setProperty("--main-color", newcolor);
        });
      });
      </script>
</html>
