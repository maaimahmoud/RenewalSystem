@extends('layout')
<style>

 .card2{
    border-style: solid;
    border-width: thin;
    border-color: #2196F3;
  }
  </style>
@section('content')

<div class="row">
<div class="col-md-10"></div>
<div class="dropdown col-md-2">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Filter by services
    </button>
    <div class="dropdown-menu pre-scrollable" aria-labelledby="dropdownMenuButton">
      @foreach ($services as $service)
    <a class="dropdown-item" href="{{url('filter/client/'.$service->id)}}">{{$service->title}}</a>
      @endforeach
    </div>
  </div>
</div>


@if (@isset($clients))

<div class="btn-group-vertical pre-scrollable full-height sub-list">
      @foreach ($clients as $value)
        <a href="{{url('/clients/'. $value{'id'})}}">
          <div class="card2">
        <div class="card align-items-center" >
          <div class="card-block text-center">
            <h4 class="card-title">{{ $value{'name'} }}</h4>
            <h6 class="card-subtitle mb-2 text-muted">Number of Services: {{ count($value{'services'}) }}</h6>
          </div>
        </div>
      </div>
      </a>
      @endforeach
</div>
{{$clients->links()}}
@else
    <p>No Clients Found</p>
@endif

@endsection
