@extends('layouts.app')

@section('content')
<div class="mt-4" >
<form method="POST" action="{{route('clients.store')}}">
  @csrf
  <div class="form-group">
    <div class="col-md-4 mb-3">
      <label for="title">Name</label>
      <input type="text" class="form-control is-valid" name="name" placeholder="Name"  required>
      <div class="invalid-feedback">)
		Duplicate Title
      </div>
    </div>

    <div class="col-md-4 mb-3">
        <label for="title">Email</label>
        <input type="email" class="form-control is-valid" name="email" placeholder="Email"  required>
        <div class="invalid-feedback">)
            Duplicate Title
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <label for="title">Phone</label>
        <input type="tel" class="form-control is-valid" name="phone_number" placeholder="Phone"  required>
        <div class="invalid-feedback">)
            Duplicate Title
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <label for="title">Address</label>
        <input type="text" class="form-control is-valid" name="address" placeholder="Address">
        <div class="invalid-feedback">)
            Duplicate Title
        </div>
    </div>

    </div>
  <button class="btn btn-primary col-md-2 ml-5" type="submit"  >Confirm</button>

</form>
</div>

@endsection
