@extends('layouts.app')
<style>
.card-body-custom{
  padding:.75rem 1.25rem;
}
.card-body-custom:nth-child(odd){
  background:#eee;
}
.label img {
  max-width: 70px;
  margin-right: 20px;
}
</style>
@section('content')

<div class="row">
  <div class="col-7">

    <div class="title py-3 ml-auto mr-auto " text-center>
         <div class="card"  >
           @if ($relation->end_time> date('Y-m-d'))
             <div class="card-header">
               <ul class="nav nav-tabs card-header-tabs">
                 <li class="nav-item">
                    <a class="nav-link Edit" href="{{url('/clients/'. $client{'id'}.'/service/'.$relation{'id'}.'/edit')}}">Edit</a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link Edit" data-toggle="modal" data-target="#modalPayment">Pay for Service</a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link Delete " data-toggle="modal" data-target="#stopServiceModal">Stop Service</a>
                 </li>
                 <li class="nav-item">
                   <a class="nav-link Delete " data-toggle="modal" data-target="#deleteServiceModal">Delete Service</a>
                 </li>
               </ul>
             </div>
          @endif
            <div class="card-body-custom text-dark bg-grey-light-3">
                <h5 class="card-title"> <strong>Client: </strong> <a href="{{ route('clients.show',['id' => $client->id]) }}"> {{ $client->name }} </a> </h5>
             </div>
             <div class="card-body-custom text-dark bg-grey-light-3">
                <h5 class="card-title"><strong>Service: </strong> <a href="{{ route('services.show',['id' => $service->id]) }}"> {{ $service->title }} </a> </h5>
             </div>
             <div class="card-body-custom text-dark bg-grey-light-3">
              <h5 class="card-title"><strong>Service cost:</strong> <span class="badge badge-pill badge-primary " >{{$service->cost.' LE every '.$service->payment_method->months.' months'}}</span> </h5>
            </div>
             <div class="card-body-custom text-dark bg-grey-light-3">
                <h5 class="card-title"><strong>Payment method:</strong> <span class="badge badge-pill badge-primary ">{{$payment_method->title}}</span> </h5>
             </div>
             <div class="card-body-custom text-dark bg-grey-light-3">
                <h5 class="card-title"><strong>Required Money: </strong> {{$relation->required_money}} </h5>
              </div>
             <div class="card-body-custom text-dark bg-grey-light-3">
               <h5 class="card-title"><strong>Balance: </strong> {{$relation->balance}} </h5>
             </div>
             <div class="card-body-custom text-dark bg-grey-light-3">
                 @php
                   $start=$relation->created_at;
                   $start=substr_replace($start ,"",-9);
                 @endphp
                 <h5 class="card-title"><strong>Start date:</strong> {{ $start }}</h5>
             </div>
             <div class="card-body-custom text-dark bg-grey-light-3">
                 @php
                   $end=$relation->end_time;
                   $end=substr_replace($end ,"",-9);
                 @endphp
                 <h5 class="card-title"><strong>End date:</strong> {{ $end }}</h5>
             </div>
          </div>
        </div>

  </div>
    <div class="col-5">
      <h5>Mailing reminder system</h5>
      <h6>System will send emails before due date as follows:</h6>
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col"># Reminder</th>
                <th scope="col">days</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($mailing_methods as $key => $value)
                <tr>
                  <th scope="row">{{$key+1}}</th>
                  <td>{{$value->days_to_mail}}</td>
                  <td>
                    <a class="btn btn-outline-primary" data-toggle="modal" data-target="#editreminderModal{{ $value->days_to_mail }}" style="color:blue;margin-right: 5px; border: none; background: none;">Edit</a>
                    <a  class="btn btn-outline-primary" data-toggle="modal" data-target="#deletereminderModal{{ $value->days_to_mail }}" style="color:blue;margin-left: 5px;border: none; background: none;">Delete</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
    </div>
   </div>




 <!-- Modal -->
 <div class="modal fade" id="modalPayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Pay for Service</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="GET" action="{{url('/clients/'.$client->id.'/service/'.$relation->id.'/pay')}}">
          <div class="modal-body">
              <input id="pay_input" type="number" min="0" name="money">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary"  data-dismiss="modal">Cancel</button>
            <button  type="submit" class="btn btn-outline-primary">Pay</button>
          </div>
          </form>
      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="stopServiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Stop Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to stop this service from {{ $client->name }}?</p>

        <p>Note: This client has {{ $relation->required_money }} LE late fees.</p>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-outline-primary"  data-dismiss="modal">Cancel</a>
        <a type="button" class="btn btn-outline-primary" href="{{ route('client.service.stop',['clients'=>$client->id , 'service'=>$relation->id ] ) }}">Stop</a>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="deleteServiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete all records of this service from {{ $client->name }}?
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-outline-primary"  data-dismiss="modal">Cancel</a>
        <a type="button" class="btn btn-outline-primary" href="{{ route('client.service.delete',['clients'=>$client->id , 'service'=>$relation->id ] ) }}">Delete</a>
      </div>
    </div>
  </div>
</div>

@foreach($mailing_methods as $value )

		@if (count($mailing_methods) > 1 )
		<div class="modal fade" id="deletereminderModal{{ $value->days_to_mail }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
										<div class="modal-header">
												<h5 class="modal-title" id="deleteModalLongTitle">Delete</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
										</div>
										<div class="modal-body">
											Are you sure you want to delete this mailing reminder?
										</div>
										<div class="modal-footer">
											<a type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</a>
												<a type="button" class="btn btn-outline-primary" href="{{route('client.service.deleteReminder',['client_service_id'=>$relation->id,'days_to_mail'=>$value->days_to_mail])}}">Delete</a>
								</div>
							</div>
						</div>
			</div>	
		@endif            
				
				<div class="modal fade" id="editreminderModal{{ $value->days_to_mail}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header light-blue darken-3 white-text">
													<h5 class="modal-title" id="editModalLongTitle">Edit</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body mb-0">
														<form action="{{ route('client.service.editReminder',['days_to_mail'=>$value->days_to_mail, 'client_service_id'=>$relation->id]) }}" method="POST">
																@csrf
																	<input name="_method" type="hidden" value="PUT">
																		<div class="md-form form-sm" >
																					<i class="fa fa-tag prefix"></i>
																					<label for="form21">Days before mail</label>
																					<input type="number" class="form-control" name="day_to_mail"  value="{{$value->days_to_mail}}" required>
																		<div class="text-center mt-1-half">
																			<button type ="submit" class="btn btn-outline-primary"><i class="fa fa-send ml-1"></i>Edit</button>
																			<button type ="submit" class="btn btn-outline-primary" data-dismiss="modal"><i class="fa fa-send ml-1"></i>Cancel</button>
																		</div>
											</div>
										</form>
									</div>
								</div>
							</div>
				</div>
		@endforeach

@endsection
