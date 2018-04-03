@extends('layouts.app')


@section('content')

  <script type="text/javascript">
    window.onload = function(){
      $("#searchbutton").css("display", "block");
      $('#searchform').attr('action', '{{url('/search/client')}}');
    };
 </script>

<div class="row">
  <div class="col-2">
    <div id="myDropdown" class="pre-scrollable full-height" >
      <h5>Filter by Service</h5>
      <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
      @foreach ($services as $service)
        <a class="dropdown-item" href="{{url('filter/client/'.$service->id)}}">{{$service->title}}</a>
      @endforeach
    </div>
  </div>

  <div class="col-10">
    @if (@isset($chosen_service))
      <h4>Clients have <a href="{{ route('services.show',['id' => $service->id]) }}"> {{ $chosen_service->title }} </a> service</h4>
    @endif

    @if (@isset($key))
      <h4>Clients: Search result for "{{ $key }}": </h4>
    @endif
    @if (count($clients)>0)

      <div class="btn-group-vertical full-height sub-list">
        @foreach ($clients as $value)
          <a href="{{url('/clients/'. $value{'id'})}}">
            <div class="card align-items-center sub-list-item" >
              <div class="card-block text-center" style=" position: relative; top:50%; transform: translateY(-50%);">
                <h4 class="card-title">{{ $value{'name'} }}</h4>
                <h6 class="card-subtitle mb-2 text-muted">Number of Services: {{ count($value{'services'}) }}</h6>
              </div>
            </div>
          </a>
        @endforeach
      </div>
      {{$clients->appends(Request::only('search'))->links()}}
    @else
      <h5 style="text-align:center; margin-top:100px">No Clients Found</h5>
    @endif
</div>
</div>


@endsection

@section('js')

<script>
    function filterFunction() {
        var input, filter, a, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        div = document.getElementById("myDropdown");
        a = div.getElementsByClassName("dropdown-item");
        for (i = 0; i < a.length; i++) {
            if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }
</script>

@endsection
