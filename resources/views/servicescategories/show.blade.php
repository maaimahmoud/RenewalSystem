@extends('layout')
@section('content')
@if (count($categories)>0)
<div class="row">
	@foreach ($categories as $category)
  <div class="col-sm-5 ml-4 mr-5 mt-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{ $category->title}}</h5>
        <span class="badge badge-pill badge-success">Number of services : 3</span>
        <div align="right">
	
       <a><button type="button" class="btn btn-outline-success" data-product_id="{{ $category->id }}" data-product_name="{{ $category->title}}"data-toggle="modal" data-target="#EditModalCenter{{$category->id}}">Edit</button></a>

       <a><button type="button" class="btn btn-outline-success" data-product_id="{{ $category->id }}" data-product_name="{{ $category->title}}" data-toggle="modal" data-target="#DeleteModalCenter">Delete</button></a>

	</div>
      </div>
    </div>
 
@foreach ($categories as $category)
      <div class="modal fade" id="DeleteModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="DeleteModalLongTitle">Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this category?
          </div>
          <div class="modal-footer">
            <a type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
              <a type="button" class="btn btn-secondary" href="{{url('/servicescategories/delete/'.$category->id)}}">Delete</a>
       
                   </div>
        </div>
</div>
</div>
@endforeach
@foreach ($categories as $category) 
<div class="modal fade" id="EditModalCenter{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="EditModalLongTitle">Editing Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          	  <div class="col-md-4 mb-3">
      <label for="title">title</label>
    	<input type="text" class="form-control is-valid" name="name" placeholder="Name" value="{{ ($category->title)}}"  required>
      <div class="invalid-feedback">)
		Duplicate Title
      </div>
   		 </div>
          </div>
          <div class="modal-footer">
            <a type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
              <a type="button" class="btn btn-secondary" href="{{url('/servicescategories/update/'.$category->id)}}">Delete</a>
          
            </div>
        </div>
    </div>
      </div>
      @endforeach
</div>
	@endforeach
</div>	
  
@else
<div class="alert alert-danger" role="alert"> there is no categories </div>
@endif




@endsection











