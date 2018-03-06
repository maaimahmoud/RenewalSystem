@extends('layout')

@section('title')

@endsection

@section('content')
  <style type="text/css">
        .sub-list{
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 10px;
            padding: 10px;
            overflow-y: auto;
        }
  </style>

  <div class="row full-height align-items-center">
          <div class="col-4 " style="max-width:25%;">
            <div class="list-group" id="list-tab" role="tablist">
              <a class="list-group-item list-group-item-action" data-toggle="list" href="#list-service" role="tab" aria-controls="service">Service</a>
              <a class="list-group-item list-group-item-action" data-toggle="list" href="#list-client" role="tab" aria-controls="client">Client</a>
              <a class="list-group-item list-group-item-action" data-toggle="list" href="#list-statistics" role="tab" aria-controls="statistics">Statistics</a>
              <a class="list-group-item list-group-item-action" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Settings</a>
            </div>
          </div>
         <div class="col-8">
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show" id="list-service" role="tabpanel" aria-labelledby="list-service-list">
                    <div class="btn-group-vertical pre-scrollable full-height sub-list">
                      <div class="card align-items-center">
                        <div class="card-block text-center">
                          <h4 class="card-title">Service title</h4>
                          <h6 class="card-subtitle mb-2 text-muted">Category: 1</h6>
                          <h6 class="card-subtitle mb-2 text-muted">Number of Clients: 5</h6>
                          <a href="#" class="card-link">View Service</a>
                        </div>
                      </div>
                    </div>
                  </div>
                    <div class="tab-pane fade" id="list-client" role="tabpanel" aria-labelledby="list-client-list">
                      <div class="btn-group-vertical pre-scrollable full-height sub-list">
                          <a class="btn btn-primary btn-lg">Add Client</a>
                          <a class="btn btn-primary btn-lg">View All Clients</a>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="list-statistics" role="tabpanel" aria-labelledby="list-statistics-list">

                    </div>
                    <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                          <div class="w3-col l4 m12" style="text-align:center;">
                                <h3>Pick a Color:</h3>
                                <input type="color" id="html5colorpicker" value="#bbbbbb" style="width:30%;">
                          </div>
                    </div>
              </div>
      </div>
    </div>



@endsection
