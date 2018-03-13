@extends('layout')

@section('content')
<div class="mt-4" >
<form method="POST" action="{{route('clients.addservice', ['id' => $client->id])}}">
  @csrf
  <input name="_method" type="hidden" value="PUT">
  <div class="form-group">
          <div class="col-md-6 mb-3">
                  <label for="category_id">Service Category</label>

                       <select class="custom-select" value="Open this select menu" name="servicecategory" id="servicecategories">
                        <option ></option>
                            @foreach ($servicecategories as $servicecategory)
                              <option value="<?php echo $servicecategory->id; ?>">{{$servicecategory->title}}</option>
                            @endforeach
                        <option> <a href="/servicecategories/AddCategory" > Add new Category</a></option>
                      </select>
          </div>


          <div class="col-md-6 mb-3">
                  <label for="service_id">Services</label>
                       <select class="custom-select" value="Open this select menu" name="service" id="services" required>
                        <option value="0"> </option>

                        @foreach ($servicecategories as $servicecategory)
                          <div class="'category'+<?php echo $servicecategory->id; ?>">

                            @foreach ($services as $service)
                                @if ($service->category_id == $servicecategory->id)
                                  <option value="<?php echo $service->id; ?>" >{{$service->title}}</option>
                                @endif
                            @endforeach
                          </div>
                        @endforeach

                        <option> <a href="/services/addservice" > Add new Service</a></option>
                         </select>
          </div>


          <div class="col-md-6 mb-3">
                  <label for="payment_method_id">PaymentMethod</label>
                       <select class="custom-select" value="Open this select menu" name="payment_method" required>
                        <option value="1"></option>
                            @foreach ($paymentmethods as $payment_method)
                              <option value="<?php echo $payment_method->id; ?>">{{$payment_method->title}}</option>
                            @endforeach
                            <option> <a href="/paymentmethods/AddPaymentMethod" > Add new PaymentMethod</a></option>
                      </select>
          </div>
    </div>
<div class="col-md-6 mb-3">
        <label for="end_date">Service end date</label>
        <br>
        <input type="date" name="end_date" min="2000-01-02" required>
        <br><br>
      </div>


  <button class="btn btn-primary col-md-2 ml-5" type="submit"  >Confirm</button>

</form>
</div>

<div style="display:none; ">

  @foreach ($servicecategories as $servicecategory)
    <div id="<?php echo $servicecategory->id; ?>">
        @foreach ($services as $service)
            @if ($service->category_id == $servicecategory->id)
              <option value="<?php echo $service->id; ?>" >{{$service->title}}</option>
            @endif
        @endforeach
    </div>
  @endforeach

</div>

@endsection
