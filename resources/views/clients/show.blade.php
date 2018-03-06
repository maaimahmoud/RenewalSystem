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
                <a class="nav-link Edit" href="/Home/EditService{id}">Edit</a>
              </li>
              <li class="nav-item">
                <a class="nav-link Delete" href="/Home/Delete{id}">Delete</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <h4 class="card-title">{{$client->name}}</h4>
            <h5>email: {{ $client->email }}</h5>
            <h5>Phone number: {{ $client->phone_number }}</h5>
            <h5>Address: {{ $client->address }}</h5>
            <p align="right">
            <button type="button-right" class="btn btn-outline-primary">Back</button></p>
          </div>
      </div>
  </div>




@endsection
