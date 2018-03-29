
@extends('layouts.app')
<style>

 .card2{
    border-style: solid;
    border-width: thin;
    border-color: #2196F3;
  }
  </style>
@section('content')

<div align ="right">
 <a type="button" data-toggle="modal" data-target="#addmodalpaymentmethod" class="btn btn-outline-primary col-md-2 ml-5" >Add New</a>
  </div>
  @if (count($paymentmethods)>0)
<div class="row"> 
@foreach ($paymentmethods as $payment)
    <div class="col-sm-3 ml-4 mr-5 mt-3">
  <div class="card2">
      <div class="card-body">
        <h5 class="card-title">{{ $payment->title}}</h5>
         <span class="badge badge-pill badge-primary mb-3">{{ $payment->months}} months </span>
        <p align="right">
         <a type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#editModalCenter{{ $payment->id }}">Edit</a>
          <a type="button" class ="btn btn-outline-primary" data-toggle="modal" data-target="#deleteModalCenter{{ $payment->id }}">Delete</a>
        </p>
      </div>
    </div>
  </div>
  @endforeach
       @else
<div class="alert alert-danger" role="alert"> there is no PaymentMethods </div>
@endif
</div>
@foreach ($paymentmethods as $payment)
     <div class="modal fade" id="deleteModalCenter{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteModalLongTitle">Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this payment Method ?
          </div>
          <div class="modal-footer">
            <a type="button" class= "btn-outline-primary" data-dismiss="modal">Cancel</a>
            <a type="button" class="btn btn-outline-primary" href="{{url('/paymentmethods/delete/'.$payment->id)}}">Delete</a>
          </div>
        </div>

          </div>
        </div>


@endforeach
            @foreach ($paymentmethods as $payment)
                <div class="modal fade" id="editModalCenter{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header light-blue darken-3 white-text">
                              <h5 class="modal-title" id="editModalLongTitle">Edit</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body mb-0">
                              <form action="{{url('/paymentmethods/edit/'.$payment->id)}}" method="POST">
                                    @csrf
                                    {{ method_field('PUT') }}
                                        <div class="md-form form-sm" >
                                            <i class="fa fa-tag prefix"></i>
                                             <label for="form21">Title</label>
                                            <input type="text" class="form-control" name="title"  value="{{$payment->title}}" required>
                                        </div>
                                        <div class="md-form form-sm" >
                                            <i class="fa fa-tag prefix"></i>
                                             <label for="form21">Number of months</label>
                                            <input type="number" class="form-control" name="months" min=1  value={{ $payment->months}} required>
                                        </div>
                                        <div class="text-center mt-1-half">
                                            <button type ="submit" class="btn btn-secondary " ><i class="fa fa-send ml-1"></i>Edit</button>
                                            <a type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
    


   
@endsection
