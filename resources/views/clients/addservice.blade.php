@extends('layout')

@section('content')
<div class="mt-4" >
  <form method="POST" id="addservicetoclientform" action="{{route('clients.addservice', ['id' => $client->id])}}">
    @csrf
    <input name="_method" type="hidden" value="PUT">

    <h2 style="text-align: center;">Adding new service to {{ $client->name }}</h2>
    <br> <br>

    <div class="form-group col-md-6 mb-3">


          <label for="category_id">Service Category</label>

               <select class="custom-select" value="Open this select menu" name="servicecategory" id="servicecategories">
                <option ></option>
                    @foreach ($servicecategories as $servicecategory)
                      <option value="<?php echo $servicecategory->id; ?>">{{$servicecategory->title}}</option>
                    @endforeach
                <option> <a href="/servicecategories/AddCategory" > Add new Category</a></option>
              </select>


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


          <label for="payment_method_id">PaymentMethod</label>
               <select class="custom-select" value="Open this select menu" name="payment_method" id="payment_method" required>
                <option value="0"></option>
                    @foreach ($paymentmethods as $payment_method)
                      <option value="<?php echo $payment_method->id; ?>">{{$payment_method->title}}</option>
                    @endforeach
                    <option> <a href="/paymentmethods/AddPaymentMethod" > Add new Payment method</a></option>
              </select>


              <label for="end_date">Service end date</label>
              <br>
              <input type="date" name="end_date" min="2000-01-02" required>
              <br><br>

              <input style="display:none;" type="number" name="numberofreminders" id="numberofreminders" value="1">

              <label for="Mail Reminder">Send mail to remind about due date (max 10) </label>
                <div class="mailreminderinputs">
                  <input type="number" class="form-control is-valid" name="mailreminder1" placeholder="First Reminder" min="1" id="mailremind1">
                </div>

                <br>
                <button type="button" class="btn btn-link" id="addAnotherRemindMail" style="background-color:white;">+ Add another reminder</button>
                <br>

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
