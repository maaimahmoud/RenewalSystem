@extends('layouts.app')

@section('content')
<div class="mt-4" >
  <h4 style="text-align: center;">Editing <a href="{{route('clients.show',['id'=>$client->id])}}"> {{ $client->name }}</a> Information</h4>
<form method="POST" action="{{route('clients.update', $client->id)}}">
  @csrf
  <input name="_method" type="hidden" value="PUT">
  <div class="form-group">
    <div class="col-md-4 mb-3">
      <label for="title">Name</label>
    <input type="text" maxlength=40 class="form-control is-valid" name="name" placeholder="Name" value="{{$client->name}}"  required>
      <div class="invalid-feedback">)
		Duplicate Title
      </div>
    </div>

    <div class="col-md-4 mb-3">
        <label for="title">Email</label>
        <input type="email" class="form-control is-valid" name="email" placeholder="Email" value="{{$client->email}}" required>
        <div class="invalid-feedback">)
            Duplicate Title
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <label for="title">Phone</label>
        <input type="number" min=1 step="1" class="form-control is-valid" name="phone_number" placeholder="Phone" value="{{$client->phone_number}}" required>
        <div class="invalid-feedback">)
            Duplicate Title
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <label for="title">Address(optional)</label>
        <input type="text" class="form-control is-valid" name="address" placeholder="Address" value="{{$client->address}}">
        <div class="invalid-feedback">)
            Duplicate Title
        </div>
    </div>

    </div>
  <button class="btn btn-primary col-md-2 ml-5" type="submit">Confirm</button>

</form>
</div>

@endsection
