{{-- <h1>Hi</h1>
<p>Sending Mail from Laravel.</p> --}}
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" >
<style>
.card{

}
</style>
<div class= "container-fluid ">
	<div class="card border-primary ml-auto mt-5 mr-auto"> 
	  <div class="card-body text-dark">
	    <h5 class="card-title">Dear {{ $client_name }}, </h5>
	    <p class="card-text"><strong>Ismart </strong>remindes you that you have to pay {{ $cost - $balance + $required_money }} LE within {{$days}} days for {{ $service_name }}.</p>
	  </div>
	</div>
</div>







