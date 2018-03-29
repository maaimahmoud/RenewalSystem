@extends('layouts.app')

@section('content')

  <script type="text/javascript">
    window.onload = function(){
      $("#searchbutton").css("display", "block");
      $('#searchform').attr('action', '{{url('/search/service')}}');
    };
 </script>

<div class="row">
  <div class="col-md-10"></div>
  <div class="dropdown col-md-2">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Filter by categories
      </button>
      <div id="myDropdown" class="dropdown-menu pre-scrollable" aria-labelledby="dropdownMenuButton">
        <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
        @foreach ($categories as $category)
          <a class="dropdown-item" href="{{url('filter/service/'.$category->id)}}">{{$category->title}}</a>
        @endforeach
      </div>
    </div>
  </div>

  @if (@isset($services))

<div class="btn-group-vertical pre-scrollable full-height sub-list">
      @foreach ($services as $value)
        <a href="{{url('/services/'. $value{'id'})}}">
        <div class="card align-items-center">
          <div class="card-block text-center">
            <h4 class="card-title">{{ $value{'title'} }}</h4>
            <h6 class="card-subtitle mb-2 text-muted">Category: {{ $value->service_categories->title }}</h6>
          </div>
        </div>
      </a>
      @endforeach
</div>
{{$services->links()}}
@else
    <p>No Services Found</p>
@endif

@endsection


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
