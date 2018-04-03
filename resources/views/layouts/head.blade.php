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
    a{
      color: black;
    }
    .nav-link:hover{
      cursor: pointer;
    }
    .sub-list{
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-gap: 10px;
        padding: 30px;
        overflow-y: auto;
    }

    .sub-list-item{
      overflow: hidden;
      width: 250px;
      max-width: 250px;
      height: 160px;
      max-height: 160px;
    }

    #searchbutton{
      display: none;
    }

    ::-webkit-scrollbar {
            -webkit-appearance: none;
            width: 7px;
        }
        ::-webkit-scrollbar-thumb {
            border-radius: 4px;
            background-color: rgba(0,0,0,.5);
            -webkit-box-shadow: 0 0 1px rgba(255,255,255,.5);
        }

        .no-js #loader { display: none;  }
        .js #loader { display: block; position: absolute; left: 100px; top: 0; }
        .se-pre-con {
        	position: fixed;
        	left: 0px;
        	top: 0px;
        	width: 100%;
        	height: 100%;
        	z-index: 9999;
        	background: url(images/Preloader.gif) center no-repeat #fff;
        }

        .search-form .form-group {
            float: right !important;
            transition: all 0.35s, border-radius 0s;
            width: 32px;
            height: 32px;
            background-color: #fff;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
            border-radius: 25px;
            border: 1px solid #ccc;
          }
          .search-form .form-group input.form-control {
            padding-right: 20px;
            border: 0 none;
            background: transparent;
            box-shadow: none;
            display:block;
          }
          .search-form .form-group input.form-control::-webkit-input-placeholder {
            display: none;
          }
          .search-form .form-group input.form-control:-moz-placeholder {
            /* Firefox 18- */
            display: none;
          }
          .search-form .form-group input.form-control::-moz-placeholder {
            /* Firefox 19+ */
            display: none;
          }
          .search-form .form-group input.form-control:-ms-input-placeholder {
            display: none;
          }
          .search-form .form-group:hover,
          .search-form .form-group.hover {
            width: 20%;
            border-radius: 25px;
          }
          .search-form .form-group span.form-control-feedback {
            position: absolute;
            top: -1px;
            right: -2px;
            z-index: 2;
            display: block;
            width: 34px;
            height: 34px;
            line-height: 34px;
            text-align: center;
            color: #3596e0;
            left: initial;
            font-size: 14px;
          }

    </style>

    @yield('css')


        <!-- Scripts -->
        {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script> --}}
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}" > </script>
        <script src="{{ asset('js/popper.min.js') }}" > </script>
        <script src="{{ asset('js/layout.js') }}"></script>



        <script src="{{ asset('js/app.js') }}"></script>

        <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

        @yield('js')

</head>
