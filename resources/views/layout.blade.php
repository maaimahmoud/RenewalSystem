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
                height : 63px;
            }

            .navbaar a{
                float: left;
                font-size: 23px;
                color: black;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
                cursor: pointer;
            }

            .dropdoown {
                float: left;
                overflow: hidden;
            }

            .dropdoown .dropbtn {
                font-size: 23px;
                border: none;
                outline: none;
                color: black;
                padding: 14px 16px;
                background-color: inherit;
                font-family: inherit;
                margin: 0;
            }

            .nav-content a:hover, .dropdoown:hover .dropbtn {
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

            .searchbar{
              position: absolute;
              top:65px;
              right:0;
              max-width: 30%;
              margin-right: 45px;
              border-color: var(--main-color);
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
              <a href="/services">View All Services</a>
              <a data-toggle="modal" data-target="#modalservicecategoryForm">Add category</a>
              <a href="/servicescategories">View All Categories</a>
          </div>
      </div>

       <div class="dropdoown">
          <button class="dropbtn">Payment method
            <i class="fa fa-caret-down"></i>
          </button>
          <div class="dropdoown-content">
              <a data-toggle="modal" data-target="#modalpaymentmethodForm">Add Payment method</a>
              <a href="/paymentmethods">View All</a>
          </div>
      </div>

      <a href="#statistics">Statistics</a>

      <a href="/settings">Settings</a>

      <a data-toggle="collapse" data-target=".search-input"> Search </a>

    </div>
</div>
        <div class="container collapse search-input searchbar">
        <form class="row" id="demo-2" method="POST" action="{{url('/search/client')}}">
            {{ csrf_field() }}
            <input type="text" name="search" class="search form-control" placeholder="Search">
          </form>
        </div>

      <div class="contain er-fluid full-height ">
            @yield('content')
      </div>

      <div class="footer-copyright py-3 text-center">
          <div class="container-fluid">
              © 2018 Copyright: <a href="#"> Renewal System </a>
          </div>
      </div>

      <div class="modal fade" id="modalservicecategoryForm" tabindex="-1" role="dialog" aria-labelledby="modalservicecategoryFor" aria-hidden="true">
    <!--Modal: Contact form-->
    <div class="modal-dialog cascading-modal" role="document">

        <!--Content-->
        <div class="modal-content">

            <!--Header-->
            <div class="modal-header primary-color white-text">
                <h4 class="title">
                    <i class="fa fa-pencil"></i> Add Category</h4>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--Body-->
            <div class="modal-body">
               <form action="{{url('/servicescategories/create')}}" method="POST">
            @csrf
              {{ method_field('POST') }}
                <!-- Material input name -->
                <div class="md-form form-sm">
                    <i class="fa fa-envelope prefix"></i>
                    <label for ="modalservicecategoryForm">Title</label>
                    <input type="text" name="title"  id="modalservicecategoryForminput" class="form-control form-control-sm" required>
                </div>
                <div class="text-center mt-4 mb-2">
                  <button type ="submit" class="btn btn-secondary " ><i class="fa fa-send ml-1"></i>Add</button>
                          <a type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                </div>
              </form>
            </div>
        </div>
        <!--/.Content-->
    </div>
    <!--/Modal: Contact form-->
</div>
     
        <div class="modal fade" id="modalpaymentmethodForm" tabindex="-1" role="dialog" aria-labelledby="modalpaymentmethodForm" aria-hidden="true">
    <!--Modal: Contact form-->
    <div class="modal-dialog cascading-modal" role="document">

        <!--Content-->
        <div class="modal-content">

            <!--Header-->
            <div class="modal-header primary-color white-text">
                <h4 class="title">
                    <i class="fa fa-pencil"></i> Add Paymentmethod</h4>
                <button type="button" class="close waves-effect waves-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <!--Body-->
            <div class="modal-body">
               <form action="{{url('/paymentmethods/create')}}" method="POST">
            @csrf
              {{ method_field('POST') }}
                <!-- Material input name -->
                <div class="md-form form-sm">
                    <i class="fa fa-envelope prefix"></i>
                    <label for ="modalservicecategoryForm">Title</label>
                    <input type="text" name="title"  id="modalpaymentmethodinput" class="form-control form-control-sm" required>
                </div>
                 <div class="md-form form-sm">
                    <i class="fa fa-envelope prefix"></i>
                    <label for ="modalservicecategoryForm"> Number of days</label>
                    <input type="number" name="days"  id="modalpaymentmethodinput" class="form-control form-control-sm" required>
                </div>
                <div class="text-center mt-4 mb-2">
                  <button type ="submit" class="btn btn-secondary " ><i class="fa fa-send ml-1"></i>Add</button>
                          <a type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                </div>
              </form>
            </div> 
         </div>
    </div>
 </div>         
    

      <script src="{{ asset('js/jquery-3.3.1.min.js') }}" > </script>
      <script src="{{ asset('js/popper.min.js') }}" > </script>
      <script src="{{ asset('js/bootstrap.min.js') }}" > </script>
      <script>
      $(".full-height").css({
              "min-height": $(window).height() - $(".footer-copyright").innerHeight() - $(".navbaar").innerHeight()
          });
          $(window).on('resize', function() {
              $(".full-height").css({
                "min-height": $(window).height() - $(".footer-copyright").innerHeight() - $(".navbaar").innerHeight()
          });
      });

      $(document).ready(function () {
          $('#colorpicker').change(function() {
                  var newcolor = $('#colorpicker').val();
                  document.body.style.setProperty("--main-color", newcolor);
            });

          $('#servicecategories').change(function(){
              $('#services option').remove();

              var o = new Option(" ", "0");
              /// jquerify the DOM object 'o' so we can use the html method
              $(o).html(" ");
              $("#services").append(o);


              var val=$('#servicecategories').val();

              var div=$('#'+val+' option');

              div.clone(true).appendTo("#services");

          });
      });
      </script>
</html>
