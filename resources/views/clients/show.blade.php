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

  #clientImage
  {
      max-width:180px;
      margin-left: 50px;
  }
  .clientInfo
  {
    margin:50px;
  }

  #clientName
  {
    min-width: 460px;
    margin-top: 20px;
  }

</style>
@section('content')

  <div class="row">
    <div class="col-7">

      <div class="row">
        <div class="col-4">
            <img src="/images/Person.png" alt="" id="clientImage">
        </div>
        <div id="clientName" class="col-8">
            <h5> <strong>{{ $client->name }}</strong></h5>

            <a href="{{route('clients.edit', ['id' => $client->id])}}"> <label class="btn btn-secondary"> Edit Info </label></a>

            <a class=" Delete " data-toggle="modal" data-target="#exampleModalCenter"><label class="btn btn-secondary"> Delete </label></a>
      </div>


      </div>

            <div class="clientInfo">

              <div class="card-body-custom text-dark bg-grey-light-3">
                <h6 class="card-title"><strong>Email:</strong> {{ $client->email}}</h6>
              </div>
              <div class="card-body-custom text-dark bg-grey-light-3">
                <h6 class="card-title"><strong>Mobile Number:</strong> {{ $client->phone_number}}</h6>
              </div>
              <div class="card-body-custom text-dark bg-grey-light-3">
                <h6 class="card-title"><strong>Address:</strong> {{ $client->address }}</h6>
              </div>
            </div>
    </div>

    <div class="col-5 full-height pre-scrollable">
      <div class="list-group">
          <table class="table table-hover">
              <thead class="thead-dark">
                <tr>
                  <td colspan="2" class="table">
                    <a href="{{route('clients.service.create', ['clients' => $client->id])}} " style="color:blue;">+ Add new service</a>
                  </td>
                </tr>
                <tr>
                  <th scope="col">Service</th>
                  <th scope="col">End date</th>
                </tr>
              </thead>
              <tbody>
                @if (count($client->services)>0)



                      @foreach ($client->relation as $relation)
                        @php
                            $url='/clients/'. $client{'id'}.'/service/'.$relation{'id'};
                            $end_date=$relation->end_time;
                            $end_date=substr_replace($end_date ,"",-9);
                        @endphp

                        @if ($end_date > date('Y-m-d'))
                          <tr class="table-success">
                            <td><a href="{{ $url }}" >{{$relation->title}}</a>
                       
                       </td>
                            <td>{{ $end_date }}</td>
                          </tr>
                        @else
                          <tr class="table-danger">
                            <td><a href="{{ $url }}" >{{ $relation->title }}</a></td>
                            <td>{{ $end_date }}</td>
                          </tr>
                        @endif
                      @endforeach


                  @endif
              </tbody>
            </table>


        </div>
    </div>
  </div>

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
              Are you sure you want to delete this client?
            </div>
            <div class="modal-footer">
              <a type="button" class="btn btn-outline-primary"  data-dismiss="modal">Cancel</a>
              <a type="button" class="btn btn-outline-primary"  href="{{url('/clients/delete/'.$client->id)}}">Delete</a>
            </div>
        </div>
      </div>
</div>



@endsection
