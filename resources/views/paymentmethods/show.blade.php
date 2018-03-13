@extends('layout')
@section('content')
@if (count($paymentmethods)>0)
<div class="row">
@foreach ($paymentmethods as $payment)
    <div class="col-sm-3 ml-4 mr-5 mt-3">
  <div class="card">
      <div class="card-body">
        <h5 class="card-title">{{ $payment->title}}</h5>
         <h5 class="card-title">{{ $payment->days}} days </h5>
        <p align="right">
         <a type="button" class="btn btn-secondary" data-toggle="modal" data-target="#editModalCenter{{ $payment->id }}">Edit</a>
          <a type="button" class="btn btn-secondary" data-toggle="modal" data-target="#deleteModalCenter{{ $payment->id }}">Delete</a>
        </p>
      </div>
    </div>
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
            <a type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
            <a type="button" class="btn btn-secondary" href="{{url('/paymentmethods/delete/'.$payment->id)}}">Delete</a>
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
                <h5 class="modal-title" id="editModalLongTitle">Editing payment</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
                   
                </div>
                <!--Body-->
                <div class="modal-body mb-0">
            <form action="{{url('/paymentmethods/edit/'.$payment->id)}}" method="POST">
            @csrf
            {{ method_field('PUT') }}
                      <div class="md-form form-sm" >
                          <i class="fa fa-tag prefix"></i>
                           <label for="form21">Title</label>
                          <input type="text" class="form-control" name="title"  value={{ $payment->title}} required>
                      </div>
                      <div class="md-form form-sm" >
                          <i class="fa fa-tag prefix"></i>
                           <label for="form21">Number of days</label>
                          <input type="number" class="form-control" name="days"  value={{ $payment->days}} required>
                      </div>
                      <div class="text-center mt-1-half">
                          <button type ="submit" class="btn btn-secondary " ><i class="fa fa-send ml-1"></i>Edit</button>
                          <a type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                      </div>
                    </form>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
      @endforeach

  @endforeach
</div>  
  
@else
<div class="alert alert-danger" role="alert"> there is no PaymentMethods </div>
@endif




@endsection











