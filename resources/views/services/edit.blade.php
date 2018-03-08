@extends('layout')

@section('content')
<div class="mt-4" >
<form method="POST" action="{{route('services.update', $service->id)}}">
  @csrf
  <input name="_method" type="hidden" value="PUT">
  <div class="form-group">
    <div class="col-md-4 mb-3">
      <label for="title">Service Title</label>
    <input type="text" class="form-control is-valid" name="title" placeholder="Title" value="{{$title}}" required>
      <div class="invalid-feedback">)
		Duplicate Title
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="description">Description</label>
    <textarea class="form-control is-valid" rows="5" name="description" placeholder="Description" required>{{$description}}</textarea>
    </div>
   <div class="col-md-6 mb-3">
      <label for="category_id">Category</label>
     <select class="custom-select" value ="Open this select menu" name="categories" required>
    		
     <option selected="selected">{{$category_service->title}}</option>
      @foreach ($categories as $category)
     <option>{{$category->title}}</option>
      @endforeach
      <option> <a href="/Home/AddCategory" > Add new Category</a></option>
    </select>
   	</div>
   	<div class="col-md-6 mb-3">
      <label for="cost">Cost</label>
     <input type="number" class="form-control is-valid" name="cost" placeholder="Cost" value="{{$cost}}">
        <div class="invalid-feedback">)
		Money must be positive number
      </div>
  </div>
      <div class="col-md-6 mb-3">
      <label for="payment_method_id">PaymentMethod</label>
     <select class="custom-select" value="Open this select menu" name="payment_methods" required>
      <option selected="selected">{{$pay_method->title}}</option>
      @foreach ($payment_methods as $payment_method)
        <option>{{$payment_method->title}}</option>
      @endforeach
      <option> <a href="/Home/AddPaymentMethod" > Add new PaymentMethod</a></option>
    </select>
 	</div>
    </div>
  <button class="btn btn-primary col-md-2 ml-5" type="submit"  >Confirm</button>
   </div>
  
</form>
</div>

@endsection