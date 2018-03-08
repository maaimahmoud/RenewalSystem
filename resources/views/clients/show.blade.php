@extends('layout')
<style>
.card-body-custom:nth-child(even){
        background:#eee;

    }
</style>
@section('content')

  <div class="title py-3 text-center ml-auto mr-auto col-md-6 " text-center title=" Services Information">
      <div class="card text-center "  >
          <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
              <li class="nav-item">
                <a class="nav-link View" href="/Home/Service{id}">View</a>
              </li>
              <li class="nav-item">
                <a class="nav-link Edit" href="{{route('clients.edit', $client->id)}}">Edit</a>
              </li>
              <li class="nav-item">
                <a class="nav-link Delete" data-toggle="modal" data-target="#exampleModalCenter">Delete</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <h4 class="card-title">{{$client->name}}</h4>
            <h5>email: {{ $client->email }}</h5>
            <h5>Phone number: {{ $client->phone_number }}</h5>
            <h5>Address: {{ $client->address }}</h5>

            @if (count($client->services)>0)
              <h5>Services: {{ $client->services }}</h5>
          @else
              <h5>No current services</h5>
          @endif

            <p align="right">
            <button type="button-right" class="btn btn-outline-primary">Back</button></p>
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
            <a type="button" class="btn btn-secondary" href="{{url('/clients/delete/'.$client->id)}}">Delete</a>
          </div>
        </div>
      </div>
    </div>




@endsection
