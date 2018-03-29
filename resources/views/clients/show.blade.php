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
  .card2{
    border-style: solid;
    border-width: thin;
    border-color: #2196F3;
  }
</style>
@section('content')

 <div class="title py-3 ml-auto mr-auto col-md-6 " text-center title=" Services Information">
<div class="card"  >
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
              <li class="nav-item">
      <a class="nav-link profile" href="{{route('clients.show', ['id' => $client->id])}}">Profile</a>
    </li>
      <a class="nav-link Edit" href="{{route('clients.edit', ['id' => $client->id])}}">Edit</a>
      </li>
    </li>
      <a class="nav-link" href="{{route('clients.service.create', ['clients' => $client->id])}}">Add Service</a>
      </li>
      <li class="nav-item">
        <a class="nav-link Delete " data-toggle="modal" data-target="#exampleModalCenter">Delete</a>
      </li>
    </ul>
  </div>
  <div class="card-body-custom text-dark bg-grey-light-3">
    <h5 class="card-title"> <strong>Name:</strong> {{ $client->name }}</h5>
    </div>
    <div class="card-body-custom text-dark bg-grey-light-3">
    <h5 class="card-title"><strong>Email:</strong> {{ $client->email}}</h5>
    </div>
    <div class="card-body-custom text-dark bg-grey-light-3">
    <h5 class="card-title"><strong>Mobile Number:</strong> {{ $client->phone_number}}</h5>
    </div>
    <div class="card-body-custom text-dark bg-grey-light-3">
    <h5 class="card-title"><strong>Address:</strong> {{ $client->address }}</h5>
    </div>

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
              Are you sure you want to delete this service?
            </div>
            <div class="modal-footer">
              <a type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
              <a type="button" class="btn btn-secondary" href="{{url('/clients/delete/'.$client->id)}}">Delete</a>
            </div>
        </div>
      </div>
</div>

<div>
    <div class="row">
        <div class="col-sm-12">
           <div class="card border-dark mb-3">
                <div class="card-header">{{ $client->name }} 's services</div>
                  {{--  start of for each  --}}
                  @if (count($client->services)>0)
                   <div class="row">
                      @foreach ($client->services as $service)
                          <div class="col-sm-5 ml-4 mr-4 mt-2 mb-2">
                            <div class="card2">
                              <div class="card-body" > 
                                <h5 class="card-title">{{ $service->title }}</h5>
                                <p class="card-text text-center">{{ $service->description }}</p>
                                <div align="right">
                           
                            
                                @foreach ($client->relation as $ind=>$relation)
                                  @if ($relation{'service_id'} == $service{'id'})
                                    <a href="{{url('/clients/'. $client{'id'}.'/service/'.$relation{'id'})}}") class="btn btn-outline-primary mr-3"><i class="fa fa-clone left"></i> View service</a>
                                    <a href="{{url('/clients/'. $client{'id'}.'/service/'.$relation{'id'}.'/edit')}}") class="btn btn-outline-primary mr-3"><i class="fa fa-clone right"></i> Edit service</a>
                                    <a href="{{ route('client.service.delete',['clients'=>$client->id , 'service'=>$relation->id ] ) }}" class="btn btn-outline-primary mr-3"><i class="fa fa-clone right"></i> Stop service</a>
                                      </div>
                                      @php
                                        unset($client->relation[$ind]);
                                        break;
                                      @endphp
                                  @endif
                                @endforeach
                              </div>
                            </div>
                          </div>
                      @endforeach
                        </div>
                  @else
                      <h5>No current services</h5>
                  @endif
          </div>
       </div>
    </div>
</div>
@endsection
