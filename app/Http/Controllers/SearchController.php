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

    /*
    *this function searches for a client from an input from a user
    *and searches by name, phone, address and email
    */
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
        return view('clients.index', compact('clients', 'services','key'));
    }

    /*
    * This function takes input from user and searches for a service
    * by title, description and cost
    */
    public function searchService()
    {
        //get the search key
        $key = Input::get('search');

        try
        {
            //get all clients who are related to the keyword
            $services = Service::SearchByKeyword($key)->paginate(24);

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
        return view('services.index', compact('services', 'categories','key'));
    }

}
