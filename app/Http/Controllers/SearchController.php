<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Input;

use App\Client;
use App\Service;
use App\ServiceCategories;

class SearchController extends Controller
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
    //

    
    public function searchClient()
    {
        //get the search key
        $key = Input::get('search');

        try
        {
            //get all clients who are related to the keyword
            $clients = Client::SearchByKeyword($key)->paginate(24);

            //get all services to be viewd
            $services = Service::orderBy('title')->get();
        }
        catch (QueryException $e)
        {
            $message = 'problem with connection with database';
            $myerrors = array($message);
            return redirect('/home')->withErrors($myerrors);
        }
           
        //go to view all clients
        return view('clients.index', compact('clients', 'services'));
    }


    //
    public function searchService()
    {
        //get the search key
        $key = Input::get('search');

        try
        {
            //get all clients who are related to the keyword
            $services = Service::SearchByKeyword($key)->paginate(30);

            //get all categories to be shown for filtering
            $categories = ServiceCategories::orderBy('title')->get();
        }
        catch (QueryException $e)
        {
            $message = 'problem with connection with database';
            $myerrors = array($message);
            return redirect('/home')->withErrors($myerrors);
        }    
        //go to view all clients
        return view('services.index', compact('services', 'categories'));
    }
    
}
