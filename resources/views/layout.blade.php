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
                height : 59px;
            }

            .navbaar a{
                float: left;
                font-size: 20px;
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
                font-size: 20px;
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
              <a href="/servicescategories">View All Categories</a>
          </div>
      </div>
    
      <a href="/paymentmethods">Payment Methods </a>

      <a href="#statistics">Statistics</a>

      <a href="/settings">Settings</a>

      <a data-toggle="collapse" data-target=".search-input"> Search </a>
    </div>
  </div>

</div>
        <div class="container collapse search-input searchbar">
        <form class="row" id="demo-2" method="POST" action="{{url('/search/service')}}">
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

          $('#addAnotherRemindMail').click(function(){
            var numbers=[0,"First","Second","Third","Fourth","Fifth","Sixth","Seventh","Eighth","Ninth","Tenth"];
            var value=$('#numberofreminders').val();

              if (value == 10){
                alert("Cannot add more Reminders");
              }
            else {
                  var filledReminders=0;
                  for (var i = 1; i <= value; i++) {
                    if($('#mailremind'+i).val() != "")
                        filledReminders ++;
                  }

                  if (filledReminders != value){
                    alert("Please fill existing Reminders before adding another one");
                  }
                  else {
                          var duplicate = false;
                          for (var i = 1; i <= value; i++) {
                            for (var j = i+1; j <= value; j++) {
                              if ($('#mailremind'+i).val() == $('#mailremind'+j).val()){
                                    duplicate=true;
                                    $('#mailremind'+j).val("");
                                  }
                            }
                          }



                          if (duplicate){
                            alert("Please fill existing Reminders with distinct days");
                          }
                          else{

                                var add=parseInt(value)+1;
                                $('#numberofreminders').val(add);
                                $('.mailreminderinputs').append("<br>");
                                $('#mailremind1').clone(true).attr("id","mailremind"+add).attr("name","mailreminder"+add).attr("placeholder",numbers[add]+' Reminder' ).appendTo('.mailreminderinputs').val("");
                             }
                        }
                 }
            });

            $('#addservicetoclientform').submit(function() {
                        var valid=true;
                        if ( $("#services").val() == 0){
                              alert("Please choose service to add");
                              valid= false;
                            }
                        if ( $("#payment_method").val() == 0){
                              alert("Please choose the payment method");
                              valid= false;
                            }

                        if ( $("#mailremind1").val() == ""){
                              alert("Please choose at least one mail reminder");
                              valid= false;
                            }

                        var value=$('#numberofreminders').val();
                        var duplicate = false;
                          for (var i = 1; i <= value; i++) {
                            for (var j = i+1; j <= value; j++) {
                              if ($('#mailremind'+i).val() == $('#mailremind'+j).val()){
                                    duplicate=true;
                                    $('#mailremind'+j).val("");
                                  }
                            }
                          }



                            if (duplicate){
                              alert("Please fill existing Reminders with distinct days");
                              valid=false;
                            }

                          if (!valid)
                            return false;
                            else {
                              console.log("tmaaam");
                            }

                });
      });
      </script>
</html>
