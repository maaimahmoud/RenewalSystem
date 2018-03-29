@extends('layouts.app')
@section('content')

  <div class="title py-3 text-center ml-auto mr-auto col-md-6 " text-center title=" Services Information">
<div class="card text-center "  >
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
      <a class="nav-link Edit" href="{{route('services.edit', ['id' => $service->id])}}">Edit</a>
      </li>
      <li class="nav-item">
        <a class="nav-link Delete " data-toggle="modal" data-target="#exampleModalCenter">Delete</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <h5 class="card-title">{{$service->title}}</h5>
    <p class="card-text">{{$service->description}}</p>
    <p class = " col-md-5">
      <span class="badge badge-pill badge-primary ">{{$service->cost}} LE/ {{$service->payment_method->title}}</span>
    </p>
    <p  align="right">
    <a type="button-right" class="btn btn-outline-primary" href="{{url('/services')}}">Back</a></p>
  </div>
</div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this service?
        </div>
        <div class="modal-footer">
          <a type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
          <a type="button" class="btn btn-secondary" href="{{url('/services/delete/'.$service->id)}}">Delete</a>
        </div>
      </div>
    </div>
  </div>


@endsection
