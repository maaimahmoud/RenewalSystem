<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\ClientService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('welcome');
    }
    public function getEvents()
    {

      $array=ClientService::join('clients','clients.id','=','client_services.client_id')->select('name as title','end_time as start','client_services.id as url','clients.id as id')->get();
      foreach ($array as $value) {
          $value->url='/clients/'.$value->id.'/service/'.$value->url;
      }
      unset($value->id);
      return json_encode($array);
    }

}
