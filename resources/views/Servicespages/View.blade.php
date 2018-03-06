@extends('layout')

@section('content')
<body>
  <div class="title py-3 text-center ml-auto mr-auto col-md-6" text-center title=" Services Information">
<div class="card text-center "  >
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link View" href="#">View</a>
      </li>
      <li class="nav-item">
        <a class="nav-link Update" href="#">Update</a>
      </li>
      <li class="nav-item">
        <a class="nav-link Delete" href="#">Delete</a>
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
    <button type="button-right" class="btn btn-outline-primary">Back</button></p>
  </div>
</div>
</div>
</body>

@endsection

