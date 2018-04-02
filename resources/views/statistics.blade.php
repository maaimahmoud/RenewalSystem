@extends('layouts.app')
<style>
.wordart {
  font-family: Arial, sans-serif;
  font-size: 2em;
  font-weight: bold;
  position: relative;
  z-index: 1;
  display: inline-block;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.wordart.slate {
    transform: scale(1, 1.5);
    -webkit-transform: scale(1, 1.5);
    -moz-transform: scale(1, 1.5);
    -o-transform: scale(1, 1.5);
    -ms-transform: scale(1, 1.5);
}

.wordart.slate .text {
    font-family: Times, 'Times New Roman', serif;
    font-weight: normal;
    color: #2F5485;
    text-shadow: 0.03em 0.03em 0px #B3B3B3;
}
   
</style>
@section('content')
<div class="row mb-3 ml-5">
  <div class="card bg-danger text-white ml-5 " style="width: 5rem; height: 4rem; ">
  </div>
  	 <div class="card bg-white text-dark" style="width: 10rem; height: 4rem;">
     <a href="/clients"><div class="  mt-2 ml-4"> Clients <h4>{{ $client_count }}</h4></div></a>
  	</div>

  <div class="card bg-warning text-white ml-5" style="width: 5rem; height: 4rem; ">
  </div>
  	 <div class="card bg-white text-dark" style="width: 10rem; height: 4rem;">
     <a href="/services"><div class="  mt-2 ml-4"> Services <h4>{{ $service_count }}</h4></div></a>
  	</div>


  <div class="card bg-info text-white ml-5" style="width: 5rem; height: 4rem;">
  </div>
  	<div class="card bg-light text-dark  mr-5" style="width: 10rem; ">
    <a href="/servicescategories"> <div class="  mt-2 ml-4"> Categories <h4>{{ $service_categories_count }}</h4></div></a>
  </div>

  <div class="card bg-success text-white ml-5" style="width: 5rem; height: 4rem;">
  </div>
  	<div class="card bg-light text-dark mr-5" style="width: 10rem; ">
     <a href="/paymentmethods"><div class="  mt-2 ml-4"> Methods <h4>{{ $payment_method_count }}</h4></div></a>
  </div>
  </div>


<div class="wordart slate ml-5 mb-3"><span class="text" >Statistics for the last 5 years</span></div>

<div class="container-fluid mb-5 ml-3" >
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner ">
    <div class="carousel-item active">
      	<div class="col-md-12">
            	<div class="panel panel-default">
                	<div class="panel-body">
                    {!! $client_time->html() !!}
               		 </div>
            	</div>
        	</div>
        	{!! Charts::scripts() !!}
			{!! $client_time->script() !!}
    </div>
    <div class="carousel-item">
      	<div class="col-md-12">
            	<div class="panel panel-default">
                	<div class="panel-body">
                    {!! $service_time->html() !!}
               		 </div>
            	</div>
        	</div>
        	{!! Charts::scripts() !!}
			{!! $service_time->script() !!}
    </div>
    <div class="carousel-item">
      	<div class="col-md-12">
            	<div class="panel panel-default">
                	<div class="panel-body">
                    {!! $service_categories_time->html() !!}
               		 </div>
            	</div>
        	</div>
        	{!! Charts::scripts() !!}
			{!! $service_categories_time->script() !!}
</div>
  </div>

  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>

<div class="wordart slate ml-5 mb-3"><span class="text" >Statistical Pie Charts</span></div>
<div class="container-fluid ml-5" >
<div id="carouselExampleIndicator" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicator" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicator" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicator" data-slide-to="2"></li>
     <li data-target="#carouselExampleIndicator" data-slide-to="3"></li>
  </ol>
  <div class="carousel-inner ">
    <div class="carousel-item active">
      	<div class="col-md-12">
            	<div class="panel panel-default">

                	<div class="panel-body">
                    {!! $clients_by_services->html() !!}
               		 </div>
            	</div>
        	</div>
        	{!! Charts::scripts() !!}
			{!! $clients_by_services->script() !!}
    </div>
    <div class="carousel-item">
      	<div class="col-md-12">
            	<div class="panel panel-default">
                	<div class="panel-body">
                    {!! $clients_by_categories->html() !!}
               		 </div>
            	</div>
        	</div>
        	{!! Charts::scripts() !!}
			{!! $clients_by_categories->script() !!}
    </div>
    <div class="carousel-item">
      	<div class="col-md-12">
            	<div class="panel panel-default">
                	<div class="panel-body">
                    {!! $clients_by_payment_methods->html() !!}
               		 </div>
            	</div>
        	</div>
        	{!! Charts::scripts() !!}
			{!! $clients_by_payment_methods->script() !!}
</div>
    <div class="carousel-item">
      	<div class="col-md-12">
            	<div class="panel panel-default">
                	<div class="panel-body">
                    {!! $service_by_categories->html() !!}
               		 </div>
            	</div>
        	</div>
        	{!! Charts::scripts() !!}
			{!! $service_by_categories->script() !!}
</div>
  </div>

  <a class="carousel-control-prev" href="#carouselExampleIndicator" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicator" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>



@endsection
