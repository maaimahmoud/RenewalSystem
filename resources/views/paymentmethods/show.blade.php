@extends('layout')

@section('content')

  <div class="title py-3 text-center ml-auto mr-auto col-md-6 " text-center title=" Payment method Information">
<div class="card text-center "  >
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
      <a class="nav-link Edit" href="{{route('paymentmethods.edit', ['id' => $payment_method->id])}}">Edit</a>
      </li>
      <li class="nav-item">
        <a class="nav-link Delete " data-toggle="modal" data-target="#exampleModalCenter">Delete</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <h5 class="card-title">{{$payment_method->title}}</h5>
    <p class="card-text">{{$payment_method->days." days"}}</p>
    <p  align="right">
    <a type="button-right" class="btn btn-outline-primary" href="{{url('/paymentmethods')}}">Back</a></p>
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
          Are you sure you want to delete this payment method?
        </div> 
        <div class="modal-footer">
          <a type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
          <a type="button" class="btn btn-secondary" href="{{url('/paymentmethods/delete/'.$payment_method->id)}}">Delete</a>
        </div>
      </div>
    </div>
  </div>


@endsection