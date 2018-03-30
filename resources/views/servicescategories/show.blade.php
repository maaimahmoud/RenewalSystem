@extends('layouts.app')
<style>
 .card2{
    border-style: solid;
    border-width: thin;
    border-color: #2196F3;
  }
  </style>
@section('content')

<div class="row">
  <div class="col-sm-3 ml-4 mr-5 mt-3">
    <div class="card2" style="height: 23%;">
        <div class="card-body">
          <h5 class="nav-link" data-toggle="modal" data-target="#addmodalservicescategory">+ Add new Category</h5>
        </div>
      </div>
  </div>
@if (count($categories)>0)
	@foreach ($categories as $category)
<div class="col-sm-3 ml-4 mr-5 mt-3">
  <div class="card2">
      <div class="card-body">
        <h5 class="card-title">{{ $category->title}}</h5>
      <span class="badge badge-pill badge-primary mb-3">Number of services : {{ count($category->services) }}</span>
        <div align="right">
         <a type="button" class="btn btn-outline-primary"  data-toggle="modal" data-target="#editModalCenter{{ $category->id }}">Edit</a>
          <a type="button" class="btn btn-outline-primary"  data-toggle="modal" data-target="#deleteModalCenter{{ $category->id }}">Delete</a>
        </div>
      </div>
    </div>
</div>
  @endforeach
@else
  <div class="alert alert-danger" role="alert"> there is no categories </div>
@endif
</div>
@endsection

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
            <a type="button" class="btn btn-outline-primary"  data-dismiss="modal">Cancel</a>
            <a type="button" class="btn btn-outline-primary"  href="{{url('/servicescategories/delete/'.$category->id)}}">Delete</a>
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

        <form method="POST" action="{{route('servicescategories.update', $category->id)}}">
            @csrf
            {{ method_field('PUT') }}
                      <div class="md-form form-sm" >
                          <i class="fa fa-tag prefix"></i>
                           <label for="form21">Title</label>
                          <input type="text" class="form-control" name="title"  value="{{ $category->title}}" required>
                      </div>
                      <div class="text-center mt-1-half">
                        <button type ="submit" class="btn btn-outline-primary"><i class="fa fa-send ml-1"></i>Edit</button>
                        <button type ="submit" class="btn btn-outline-primary" data-dismiss="modal"><i class="fa fa-send ml-1"></i>Cancel</button>
                      </div>
                    </form>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
     @endforeach

 <div class="modal fade" id="addmodalservicescategory" tabindex="-1" role="dialog" aria-labelledby="modalservicecategoryFor" aria-hidden="true">
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
               <form action="{{route('servicescategories.store')}}" method="POST">
            @csrf
              {{ method_field('POST') }}
                <!-- Material input name -->
                <div class="md-form form-sm">
                    <i class="fa fa-envelope prefix"></i>
                    <label for ="modalservicecategoryForm">Title</label>
                    <input type="text" name="title"  id="modalservicecategoryForminput" class="form-control form-control-sm" required>
                </div>
                <div class="text-center mt-4 mb-2">
                      <button type ="submit" class="btn btn-outline-primary"><i class="fa fa-send ml-1"></i>Add</button>
                      <button type ="submit" class="btn btn-outline-primary" data-dismiss="modal"><i class="fa fa-send ml-1"></i>Cancel</button>
                </div>
              </form>
            </div>
        </div>

    </div>
</div>
