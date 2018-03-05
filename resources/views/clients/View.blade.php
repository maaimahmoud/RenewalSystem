@extends('layout')

@section('content')

<h1>Clients</h1>

@if(count($clients)> 0)
    <ul class="list-group">
        @foreach ($clients as $client)
        <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active">
            <div class=" w-100 justify-content-between">
            <h4>{{$client->name}}</h4>
            <h5>{{$client->email}}</h5>
            </div>
        </a>
        @endforeach
    </ul>
    
@else
    <p>No Clients Found</p>
@endif


@endsection