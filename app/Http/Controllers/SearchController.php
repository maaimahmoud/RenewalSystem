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
        $clients = Client::SearchByKeyword($request->input('search'))->paginate();

        //get all services to be viewd
        $services = Service::orderBy('title')->get();
        
        //go to view all clients
        return view('clients.index', compact('clients', 'services'));
    }


    //
    public function searchService(Request $request)
    {
        //get all clients who are related to the keyword
        $services = Service::SearchByKeyword($request->input('search'))->paginate();
        
        //go to view all clients
        return view('services.index')->with('services', $services);
    }
    
}
