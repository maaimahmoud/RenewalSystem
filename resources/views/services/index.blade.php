@extends('layouts.app')


@section('content')
  <script type="text/javascript">
    window.onload = function(){
      $("#searchbutton").css("display", "block");
      $('#searchform').attr('action', '{{url('/search/service')}}');
    };
 </script>

  <div class="row">
    <div class="col-2">
      <div id="myDropdown" class="pre-scrollable full-height" >
        <h5>Filter by Category</h5>
        <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
        @foreach ($categories as $category)
          <a class="dropdown-item" href="{{url('filter/service/'.$category->id)}}">{{$category->title}}</a>
        @endforeach
      </div>
    </div>

    <div class="col-10">

      @if (@isset($chosen_category))
        <h4>Services in {{ $chosen_category->title }} category</h4>
      @endif
      @if (@isset($key))
        <h4>Services: Search result for "{{ $key }}":</h4>
      @endif

  @if (count($services) > 0)

    <div class="btn-group-vertical full-height sub-list  padding-right: 5px" >
        @foreach ($services as $value)
          <a href="{{url('/services/'. $value{'id'})}}">
                <div class="card align-items-center sub-list-item"  id="cardservice{{ $value->id}}" style=" position: relative; top:50%; transform: translateY(-50%);">
                    <div class="card-block text-center "style=" margin:5px" >
                      <h4 class="card-title">{{ $value{'title'} }}</h4>
                      <h6 class="card-subtitle mb-2 text-muted">Category: {{ $value->service_categories->title }}</h6>
                    </div>
                </div>

          </a>
          <script type="text/javascript">
              serviceColor({{ $value->category_id }},{{ $value->id }});
          </script>
        @endforeach
    </div>
    {{$services->appends(Request::only('search'))->links()}}
@else
    <h5 style="text-align:center; margin-top:100px">No Services Found</h5>
@endif

@endsection


@section('js')

  <script type="text/javascript">
    function serviceColor(x,id){
      var z ="cardservice"+id;
      var elementToColor=document.getElementById(z);

      x=x*x*x*x*x*x*x;

      var intnumber = x - 0;

      // isolate the colors - really not necessary
      var red, green, blue;

      // needed since toString does not zero fill on left
      var template = "#000000";

      // in the MS Windows world RGB colors
      // are 0xBBGGRR because of the way Intel chips store bytes
      red = (intnumber&0x0000ff) << 16;
      green = intnumber&0x00ff00;
      blue = (intnumber&0xff0000) >>> 16;

      // mask out each color and reverse the order
      intnumber = red|green|blue;

      // toString converts a number to a hexstring
      var HTMLcolor = intnumber.toString(16);

      //template adds # for standard HTML #RRGGBB
      HTMLcolor = template.substring(0,7 - HTMLcolor.length) + HTMLcolor;


      hexString = x.toString(16);
      hexString='#'+hexString;

      elementToColor.style.borderTop='thick solid '+HTMLcolor;
      elementToColor.style.borderTopWidth ='8px';
      elementToColor.style.borderBottom='thick solid '+HTMLcolor;
      elementToColor.style.borderBottomWidth ='8px';


    };

 </script>

@endsection
