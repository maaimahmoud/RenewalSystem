@extends('layouts.app')
@section('content')

    <div class="title py-3 text-center ml-auto mr-auto col-md-6 " text-center title=" Services Information">
      <div class="card text-center "  >
        <div class="card-header">
          <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
            <a class="nav-link Edit" href="{{route('services.edit', ['id' => $service->id])}}">Edit</a>
            </li>
            <li class="nav-item">
              <a class="nav-link Delete " data-toggle="modal" data-target="#exampleModalCenter">Delete</a>
            </li>
          </ul>
        </div>
        <div class="card-body" id="cardservice{{ $service->id}}">
            <h5 class="card-title" >{{$service->title}}</h5>
            <h6 class="card-text">Category: {{ $service->category->title }}</h6>
            <h6 class="card-text">Number of clients: {{ $count_clients }}</h6>
            <p class="card-text">{{$service->description}}</p>
            <p class = " col-md-5">
              <span class="badge badge-pill badge-primary ">{{$service->cost}} LE/ {{$service->payment_method->months}} months </span>
            </p>
            <p  align="right">
            <a type="button-right" class="btn btn-outline-primary" href="{{url('/services')}}">Back</a></p>
        </div>
          <script type="text/javascript">
              serviceColor({{ $service->category->id }},{{ $service->id }});
          </script>
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
              <p>Are you sure you want to delete this service?</p>
              @if($count_clients > 1)
                <p>Note: {{$count_clients}} clients are using this service</p>
              @elseif($count_clients == 1)
                 <p>Note: One client is using this service</p>
               @endif
            </div>
            <div class="modal-footer">
              <a type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
              <a type="button" class="btn btn-secondary" href="{{url('/services/delete/'.$service->id)}}">Delete</a>
            </div>
          </div>
        </div>
      </div>


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
