@extends('layout')

@section('content')

@if (@isset($clients))

<div class="btn-group-vertical pre-scrollable full-height sub-list">
      @foreach ($clients as $value)
        <a href="{{url('/clients/'. $value{'id'})}}">
        <div class="card align-items-center">
          <div class="card-block text-center">
            <h4 class="card-title">{{ $value{'name'} }}</h4>
            <h6 class="card-subtitle mb-2 text-muted">Number of Services: {{ count($value{'services'}) }}</h6>
          </div>
        </div>
      </a>
      @endforeach
</div>

@else
    <p>No Clients Found</p>
@endif

@endsection
