@extends('layouts.app')

@section('content')

@if (@isset($payment_methods))

<div class="btn-group-vertical pre-scrollable full-height sub-list">
      @foreach ($payment_methods as $payment_method)
        <a href="{{url('/paymentmethods/'. $payment_method{'id'})}}">
        <div class="card align-items-center">
          <div class="card-block text-center">
            <h4 class="card-title">{{ $payment_method{'title'} }}</h4>
            <h6 class="card-subtitle mb-2 text-muted">{{ $payment_method->months." months"}}</h6>
          </div>
        </div>
      </a>
      @endforeach
</div>

@else
    <p>No payment methods Found</p>
@endif

@endsection
