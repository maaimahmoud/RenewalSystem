<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Client;
use App\Service;
use App\ServiceCategories;

class SearchController extends Controller
{
    //
    public function searchClient(Request $request)
    {
        try
        {
            //get all clients who are related to the keyword
            $clients = Client::SearchByKeyword($request->input('search'))->paginate();

            //get all services to be viewd
            $services = Service::orderBy('title')->get();
        }
        catch (QueryException $e)
        {
            $message = 'problem with connection with database';
        }
           
        //go to view all clients
        return view('clients.index', compact('clients', 'services'));
    }


    //
    public function searchService(Request $request)
    {
        try
        {
            //get all clients who are related to the keyword
            $services = Service::SearchByKeyword($request->input('search'))->paginate();

            //get all categories to be shown for filtering
            $categories = ServiceCategories::orderBy('title')->get();
        }
        catch (QueryException $e)
        {
            $message = 'problem with connection with database';
        }    
        //go to view all clients
        return view('services.index', compact('services', 'categories'));
    }
    
}
