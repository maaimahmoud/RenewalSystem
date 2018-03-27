@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-md-10"></div>
  <div class="dropdown col-md-2">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Filter by categories
      </button>
      <div class="dropdown-menu pre-scrollable" aria-labelledby="dropdownMenuButton">
        @foreach ($categories as $category)
      <a class="dropdown-item" href="{{url('filter/service/'.$category->id)}}">{{$category->title}}</a>
        @endforeach
      </div>
    </div>
  </div>

  @if (@isset($services))

<div class="btn-group-vertical pre-scrollable full-height sub-list">
      @foreach ($services as $value)
        <a href="{{url('/services/'. $value{'id'})}}">
        <div class="card align-items-center">
          <div class="card-block text-center">
            <h4 class="card-title">{{ $value{'title'} }}</h4>
            <h6 class="card-subtitle mb-2 text-muted">Category: {{ $value->service_categories->title }}</h6>
          </div>
        </div>
      </a>
      @endforeach
</div>
{{$services->links()}}
@else
    <p>No Services Found</p>
@endif

@endsection
