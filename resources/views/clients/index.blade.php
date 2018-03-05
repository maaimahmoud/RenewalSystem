<div class = "container-fluid">

<h1>Clients</h1>

@if(count($clients)> 0)
    @foreach ($clients as $client)
        <div class = "well">
            <h3>{{$client->name}}</h3>
            <h5>{{$client->email}}</h5>
        </div>
    @endforeach
@else
    <p>No Clients Found</p>
@endif

</div>