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
           <div class="card-header">
             <ul class="nav nav-tabs card-header-tabs">
               <li class="nav-item">
                  <a class="nav-link Edit" href="{{url('/clients/'. $client{'id'}.'/service/'.$relation{'id'}.'/edit')}}">Edit</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link Delete " data-toggle="modal" data-target="#exampleModalCenter">Stop Service</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link Edit" href="/clientservice/payforservice">Pay for Service</a>
               </li>


             </ul>
           </div>
            <div class="card-body-custom text-dark bg-grey-light-3">
                <h5 class="card-title"> <strong>Client: </strong> <a href="{{ route('clients.show',['id' => $client->id]) }}"> {{ $client->name }} </a> </h5>
             </div>
             <div class="card-body-custom text-dark bg-grey-light-3">
                <h5 class="card-title"><strong>Service: </strong> <a href="{{ route('services.show',['id' => $service->id]) }}"> {{ $service->title }} </a> </h5>
             </div>
             <div class="card-body-custom text-dark bg-grey-light-3">
                <h5 class="card-title"><strong>Payment method:</strong> <span class="badge badge-pill badge-primary " title="{{$relation->required_money . ' per '. $payment_method->months .' months'}}">{{$relation->required_money}} LE/ {{$payment_method->title}}</span> </h5>
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
              </tr>
            </thead>
            <tbody>
              @foreach ($mailing_methods as $key => $value)

                <tr>
                  <th scope="row">{{$key+1}}</th>
                  <td>{{$value->days_to_mail}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
    </div>
   </div>


   <!-- Modal -->
   <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
             <div class="modal-body">
                Are you sure you want to stop this service from {{ $client->name }}?
             </div>
             <div class="modal-footer">
               <a type="button" class="btn btn-outline-primary"  data-dismiss="modal">Cancel</a>
               <a type="button" class="btn btn-outline-primary" href="{{ route('client.service.delete',['clients'=>$client->id , 'service'=>$relation->id ] ) }}">Stop</a>
             </div>
         </div>
       </div>
 </div>
@endsection
