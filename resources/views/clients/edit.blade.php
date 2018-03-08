@extends('layout')

@section('content')
<div class="mt-4" >
<form method="POST" action="{{route('clients.update', $client->id)}}">
  @csrf
  <input name="_method" type="hidden" value="PUT">
  <div class="form-group">
    <div class="col-md-4 mb-3">
      <label for="title">Name</label>
    <input type="text" class="form-control is-valid" name="name" placeholder="Name" value="{{$name}}"  required>
      <div class="invalid-feedback">)
		Duplicate Title
      </div>
    </div>

    <div class="col-md-4 mb-3">
        <label for="title">Email</label>
        <input type="email" class="form-control is-valid" name="email" placeholder="Email" value="{{$email}}" required>
        <div class="invalid-feedback">)
            Duplicate Title
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <label for="title">Phone</label>
        <input type="tel" class="form-control is-valid" name="phone_number" placeholder="Phone" value="{{$phone_number}}" required>
        <div class="invalid-feedback">)
            Duplicate Title
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <label for="title">Address</label>
        <input type="text" class="form-control is-valid" name="address" placeholder="Address" value="{{$address}}">
        <div class="invalid-feedback">)
            Duplicate Title
        </div>
    </div>
    
    </div>
  <button class="btn btn-primary col-md-2 ml-5" type="submit"  >Confirm</button>
  
</form>
</div>

@endsection