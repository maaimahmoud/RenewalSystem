@extends('layout')
<style>
.card-body-custom:nth-child(even){
        background:#eee;

    }
</style>
@section('content')

@if(count($clients)> 0)

    <div class="col-md-9 mt-4 ml-auto mr-auto">
                <div class="card border-light" >
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                    <a class="nav-link View" href="/clients">ALL Clients </a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link Edit" href="/clients/{id}/edit">Edit</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link Delete" href="/">Delete</a>
                    </li>
                    </ul>
                </div>
        @foreach ($clients as $client)
        <a href="/clients/{id}" >
            <div class="card-body-custom mt-2 " style="text-decoration:none">
                <strong> <h4>{{$client->name}}</h4> </strong>
                </div>  
            <div> <h5>{{$client->email}}</h5></div>
        </a>
    </div>
</div>
        
        @endforeach
    </ul>

                          
@else
    <p>No Clients Found</p>
@endif


@endsection