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
    <h5 class="card-title">Hena title</h5>
    <p class="card-text">Description Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid blanditiis cum explicabo similique nobis voluptatibus fugit iste tempora placeat, quasi, earum assumenda minus delectus, eveniet et doloribus quae repudiandae veniam.</p>
    <p class = " col-md-5">
      <span class="badge badge-pill badge-primary ">Cost LE / paymant_method</span>
    </p>
    <p  align="right">
    <button type="button-right" class="btn btn-outline-primary">Back</button></p>
  </div>
</div>
</div>
</body>

@endsection

