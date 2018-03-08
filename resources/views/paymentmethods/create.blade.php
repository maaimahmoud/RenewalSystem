@extends('layout')

@section('content')
<div class="mt-4" >
<form method="POST" action="{{route('paymentmethods.store')}}">
  @csrf
  <div class="form-group">
    <div class="col-md-4 mb-3">
      <label for="title">Payment method title</label>
    <input type="text" class="form-control is-valid" name="title" placeholder="Title" required>
      <div class="invalid-feedback">)
		Duplicate Title
      </div>
    </div>

   	<div class="col-md-6 mb-3">
      <label for="Number of days">Number of days</label>
     <input type="number" class="form-control is-valid" name="days" placeholder="Number of days" >
        <div class="invalid-feedback">)
		Money must be positive number
      </div>
  </div>

    </div>
  <button class="btn btn-primary col-md-2 ml-5" type="submit"  >Confirm</button>
   </div>
  
</form>
</div>

@endsection