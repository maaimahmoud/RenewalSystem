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
              .btn{
                background-color: var(--main-color);
              }
              .footer-copyright{
                background-color: var(--main-color);
                margin-top: 20px;
              }
              .navbaar-dropdoowns{
                margin-right: 5%;
              }
              .navbaar-dropdoowns div{
                margin-right: 85px;
              }
              .navbaar-dropdoowns div a{
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

              .navbaar {
                background-color: var(--main-color);
                margin-bottom: 80px;
                overflow: hidden;
                font-family: Arial, Helvetica, sans-serif;
                height : 65px;
            }

            .navbaar a{
                float: left;
                font-size: 25px;
                color: black;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }

            .dropdoown {
                float: left;
                overflow: hidden;
            }

            .dropdoown .dropbtn {
                font-size: 25px;
                border: none;
                outline: none;
                color: black;
                padding: 14px 16px;
                background-color: inherit;
                font-family: inherit;
                margin: 0;
            }

            .navbaar a:hover, .dropdoown:hover .dropbtn {
                background-color: red;
            }

            .dropdoown-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }

            .dropdoown-content a {
                float: none;
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                text-align: left;
            }

            .dropdoown-content a:hover {
                background-color: #ddd;
            }

            .dropdoown:hover .dropdoown-content {
                display: block;
            }

            .nav-content{
              float:right;
              margin-right: 50px;

            }

        </style>

        <title>{{ config('app.name','Company') }}</title>
  </head>
  <div class="navbaar">
    <a href="/"><img src="/images/company-logo.png" alt="Company logo" style=" max-width:130px; position: absolute; top: 15px; left: 50px;"></a>
    <div class="nav-content ">

      <a href="/">Home</a>
      <div class="dropdoown">
          <button class="dropbtn">Clients
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdoown-content">
              <a href="/clients/create">Add Client</a>
              <a href="/clients">View All</a>
          </div>
      </div>

      <div class="dropdoown">
          <button class="dropbtn">Service
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdoown-content">
              <a href="/services/create">Add Service</a>
              <a href="/services">View All</a>
          </div>
      </div>

      <a href="#statistics">Statistics</a>

      <a href="/settings">Settings</a>
    </div>
</div>

      <div class="contain er-fluid full-height">
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
