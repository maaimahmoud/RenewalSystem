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
                margin-bottom: 20px;
              }
              .btn{
                background-color: var(--main-color);
              }
              .footer-copyright{
                background-color: var(--main-color);
                margin-top: 20px;
              }
              #pageTitle{
                position: absolute;
                top: 20%;
                left: 45%;
                text-align: center;
                font-weight: bold;
                font-family: "Lucida Console", Monaco, monospace;
              }

        </style>

        <title>{{ config('app.name','Company') }}</title>
  </head>
      <nav class="navbar navbar-light" style="height:90px">
              <!-- Navbar content -->
              <h3 id="pageTitle">@yield('title')</h3>
      </nav>
      <a href="/"><img src="images/company-logo.png" alt="Company logo" style=" max-width:130px; position: absolute; top: 15px; left: 50px;"></a>

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
              //element.style.setProperty("--main-color", color);
              //document.body.style.setProperty('var(--main-color)', #000000);//set
              document.body.style.setProperty("--main-color", newcolor);
        });
      });
      </script>
</html>
