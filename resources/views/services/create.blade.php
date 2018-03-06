@extends('layout')

@section('content')
<div class="mt-4" >
<form>
  <div class="form-group">
    <div class="col-md-4 mb-3">
      <label for="validationServer01">Service Title</label>
      <input type="text" class="form-control is-valid" id="validationServer01" placeholder="Title"  required>
      <div class="invalid-feedback">)
		Duplicate Title
      </div>
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationServer02">Description</label>
      <input type="text" class="form-control is-valid" id="validationServer02" placeholder="Description" required>
    </div>
   <div class="col-md-6 mb-3">
      <label for="validationServer02">Category</label>
     <select class="custom-select" value ="Open this select menu" required>
    		{{-- loop foreach Category type  --}}
      <option value="1"></option>
      <option> <a href="/Home/AddCategory" > Add new Category</a></option>
    </select>
   	</div>
   	<div class="col-md-6 mb-3">
      <label for="validationServer02">Cost</label>
      <input type="number" class="form-control is-valid" id="validationServer02" placeholder="Cost">
        <div class="invalid-feedback">)
		Money must be positive number
      </div>
  </div>
      <div class="col-md-6 mb-3">
      <label for="validationServer02">PaymentMethod</label>
     <select class="custom-select" value="Open this select menu" required>
    		{{-- loop foreach Category type  --}}
      <option value="1"></option>
      <option> <a href="/Home/AddPaymentMethod" > Add new PaymentMethod</a></option>
    </select>
 	</div>
    </div>
  <button class="btn btn-primary col-md-2 ml-5" type="submit"  >Confirm</button>
   </div>

</form>
</div>

@endsection
