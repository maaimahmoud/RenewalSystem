@extends ('layout')
<style>
.card-body-custom:nth-child(even){
		background:#eee;

	}
</style>
@section('content')
<div class="col-md-9 mt-4 ml-auto mr-auto">
				<div class="card border-light" >
				<div class="card-header">
					<ul class="nav nav-tabs card-header-tabs">
					<li class="nav-item">
					<a class="nav-link View" href="/Home/">ALLServices </a>
					</li>
					<li class="nav-item">
					<a class="nav-link Edit" href="/Home/EditService{id}">Edit</a>
					</li>
					<li class="nav-item">
					<a class="nav-link Delete" href="/Home/Delete{id}">Delete</a>
					</li>
					</ul>
				</div>
				  {{--  start of foreaach  --}}
				  <a  href="/Home/Service{id}">
				  <div class="card-body-custom text-dark bg-grey-light-3 ml-2 " style=" text-decoration:none;">
				    <h5 class="card-title mt-2" ><strong>here is the Title</strong> </h5>
				    <p class=" text-center">Description
				    	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam aspernatur incidunt delectus, inventore vero quibusdam dignissimos vel quisquam aliquam maiores ab libero ex iste, eaque beatae, tenetur eum dolore voluptatem.
				    </p>
				    <p align="right">
				    <span class="badge badge-pill badge-primary"> no of clients take this Services +Clients</span></p>
				  </div>
				</a>  
				 {{-- end of foreaach --}}
				</div>


@endsection
