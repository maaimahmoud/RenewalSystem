@extends('layouts.app')


@section('content')
<<<<<<< HEAD
<div class="row">
  <div class="card bg-danger text-white ml-5 mr-5" style="width: 15rem">
    <div class="card-body">Primary card</div>
  </div>
  <div class="card bg-warning text-white mr-5" style="width: 15rem">
    <div class="card-body">Primary card</div>
  </div>
  <div class="card bg-info text-white mr-5" style="width: 15rem">
    <div class="card-body">Primary card</div>
  </div>
  <div class="card bg-success text-white mr-5" style="width: 15rem">
    <div class="card-body">Primary card</div>
  </div>
  </div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Chart Demo</div>

                <div class="panel-body">
                    {!! $chart->html() !!}
                </div>
            </div>
        </div>
    </div>
</div>
{!! Charts::scripts() !!}
{!! $chart->script() !!}
@endsection

