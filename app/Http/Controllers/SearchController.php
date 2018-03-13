<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Client;
use App\Service;

class SearchController extends Controller
{
    //
    public function searchClient(Request $request)
    {
        //get all clients who are related to the keyword
        $clients = Client::SearchByKeyword($request->input('name'));

        //$clients = Client::where('name', 'LIKE', '%'.$request->input('name').'%')->get();

        //get all services to be viewd
        $services = Service::all();
        
        //go to view all clients
        return view('clients.index', compact('clients', 'services'));
    }
}
