@extends('layout')
@section('content')
@if (count($categories)>0)
<div class="row">
	@foreach ($categories as $category)
    <div class="col-sm-3 ml-4 mr-5 mt-3">
  <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{ $category->title}}</h5>
      <span class="badge badge-pill badge-success">Number of services : {{ count($category->services) }}</span>
        <p align="right">
         <a type="button" class="btn btn-secondary" data-toggle="modal" data-target="#editModalCenter{{ $category->id }}">Edit</a>
          <a type="button" class="btn btn-secondary" data-toggle="modal" data-target="#deleteModalCenter{{ $category->id }}">Delete</a>
        </p>
      </div>
    </div>
  </div>
 
@foreach ($categories as $category)
     <div class="modal fade" id="deleteModalCenter{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLongTitle">Delete</h5>
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
           <div class="modal fade" id="editModalCenter{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header light-blue darken-3 white-text">
                <h5 class="modal-title" id="editModalLongTitle">Editing category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
                </div>
                <!--Body-->
                <div class="modal-body mb-0">
            <form action="{{url('/servicescategories/edit/'.$category->id)}}" method="POST">
            @csrf
            {{ method_field('PUT') }}
                      <div class="md-form form-sm" >
                          <i class="fa fa-tag prefix"></i>
                           <label for="form21">Title</label>
                          <input type="text" class="form-control" name="title"  value={{ $category->title}} required>
                      </div>
                      <div class="text-center mt-1-half">
                          <button type ="submit" class="btn btn-secondary " ><i class="fa fa-send ml-1"></i>Edit</button>
                          <a type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                      </div>
                    </form>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
      @endforeach

	@endforeach
</div>	
  
@else
<div class="alert alert-danger" role="alert"> there is no categories </div>
@endif




@endsection











