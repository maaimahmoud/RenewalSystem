@extends('layout')

@section('content')
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
