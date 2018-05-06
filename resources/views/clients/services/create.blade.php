@extends('layouts.app')

@section('content')
<div class="mt-4" >
    @if (!isset($current_service) )
      <form method="POST" id="servicetoclientform" action="{{route('clients.service.store', ['clients' => $client->id])}}">
        @csrf
      <h5 style="text-align:center;">Adding new service to <a href="{{route('clients.show',['id'=>$client->id])}}"> {{ $client->name }}</a></h5>
      @else
        <form method="POST" id="servicetoclientform" action="{{ route('clients.service.update',['clients'=>$client->id , 'service'=>$relation->id ] ) }}">
          @csrf
          <input name="_method" type="hidden" value="PUT">
        <h5 style="text-align: center;">Edit <a href="{{route('services.show',['id'=>$current_service->id])}}"> {{ $current_service->title }}</a> service to <a href="{{route('clients.show',['id'=>$client->id])}}">{{ $client->name }}</a></h5>
    @endif
    <div id="errors">
    </div>
    <div class="form-group col-md-6 mb-3">


          <label for="category_id" class="mb-3">Service Category</label>

               <select class="custom-select mb-3" value="Open this select menu" name="servicecategory" id="servicecategories">
                <option value=0>All Services</option>
                    @foreach ($service_categories as $servicecategory)
                      <option value="<?php echo $servicecategory->id; ?>">{{$servicecategory->title}}</option>
                    @endforeach
              </select>
          <label for="service_id" class="mb-3">Services</label>
               <select class="custom-select mb-3" value="Open this select menu" name="service" id="services" required>
                    <option disabled selected value> -- Select Service -- </option>

                    @foreach ($service_categories as $servicecategory)
                      <div class="'category'+<?php echo $servicecategory->id; ?>">

                        @foreach ($services as $service)
                            @if ($service->category_id == $servicecategory->id)
                              <option value="<?php echo $service->id; ?>" >{{$service->title}}</option>
                            @endif
                        @endforeach
                      </div>
                    @endforeach

                 </select>


          <label for="payment_method_id" class="mb-3">Payment Method</label>
               <select class="custom-select mb-3" value="Open this select menu" name="payment_method" id="payment_method" required>
                <option disabled selected value> -- Select Payment Method -- </option>
                    @foreach ($payment_methods as $payment_method)
                      <option value="<?php echo $payment_method->id; ?>">{{$payment_method->title}} ( every {{ $payment_method->months }} months)</option>
                    @endforeach
              </select>


              <label for="end_date" class="mb-3">Service end date</label>
              <br>
              <input type="date" name="end_date" min="2000-01-02" id="end_date" required>
              <br><br>

              <input style="display:none;" type="number" name="numberofreminders" id="numberofreminders" value="1">

              <label for="Mail Reminder" class="mb-3">Reminder e-mail will be sent .......... days before due date (max 10) </label>
                <div class="mailreminderinputs">
                  @if (!isset($current_service) )
                    <input type="number" class="form-control is-valid mb-3" name="mailreminder1" placeholder="Reminder" min="1" id="mailremind1">
                  @else
                    @php
                      $i=1;
                    @endphp
                    @if(count($current_mailing_methods) >0)
                      @foreach ($current_mailing_methods as $value)
                        <input type="number" class="form-control is-valid mb-3" name="mailreminder{{ $i }}" placeholder="Reminder" min="1" id="mailremind{{ $i }}" value={{$value->days_to_mail}}>
                        @php
                          $i=$i+1;
                        @endphp
                      @endforeach
                      <script type="text/javascript">
                        $('#numberofreminders').val({{ count($current_mailing_methods) }});
                      </script>
                    @else
                      <input type="number" class="form-control is-valid mb-3" name="mailreminder1" placeholder="Reminder" min="1" id="mailremind1">
                      <script type="text/javascript">
                        $('#numberofreminders').val(1);
                      </script>
                    @endif
                    
                  @endif
                </div>

                <br>
                <button type="button" class="btn btn-link" id="addAnotherRemindMail" style="background-color:white;">+ Add another reminder</button>
                <br>

    </div>

    <button class="btn btn-primary col-md-2 ml-5" type="submit"  >Confirm</button>

  </form>
</div>


<div style="display:none; ">
  <div id="category0">

    @foreach ($services as $service)
      <option value="<?php echo $service->id; ?>" >{{$service->title}}</option>
    @endforeach
  </div>

    @foreach ($service_categories as $servicecategory)
      <div id="category<?php echo $servicecategory->id; ?>">
          @foreach ($services as $service)
              @if ($service->category_id == $servicecategory->id)
                <option value="<?php echo $service->id; ?>" >{{$service->title}}</option>
              @endif
          @endforeach
      </div>
    @endforeach

</div>

<script type="text/javascript">
editserviceload();
</script>

@endsection

@section('js')

    <script type="text/javascript">
      function editserviceload(){
            var now = new Date();
            var day = ("0" + (now.getDate()+1)).slice(-2);
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
            $('#end_date').attr('min', today);
            @if (isset($current_service) )
                $('#services').val( {{ $current_service->id}} ).prop('disabled', 'disabled');
                $('#servicecategories').val( {{ $current_service->category_id}} ).prop('disabled', 'disabled');
                $('#payment_method').val( {{ $current_payment_method->id}} );
                var now = new Date("{{ $current_end_time }}");
                var day = ("0" + now.getDate()).slice(-2);
                var month = ("0" + (now.getMonth() + 1)).slice(-2);
                var end = now.getFullYear()+"-"+(month)+"-"+(day) ;
                $('#end_date').val(end);
           @endif
       };
    </script>
@endsection
