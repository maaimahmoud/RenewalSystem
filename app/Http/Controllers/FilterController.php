<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\QueryException;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

use App\Service;
use App\ServiceCategories;


class FilterController extends Controller
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
    *This function takes service from user and returns all clients using this service
    *
    */
    public function filterClientsByServices($id)
    {
        try
        {
            //get service from id
            $service = Service::find($id);

            //get all clients who takes this service
            $items = $service->clients; 

            //get page from input
            $page = Input::get('page', 1);

            //set number of items in a single page
            $perPage = 24;

            //create the clients paginator
            $clients = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
                'path' => Paginator::resolveCurrentPath()
            ]);

            //get all services
            $services = Service::orderBy('title')->get();
        }
        catch (QueryException $e)
        {
            $message = 'cannot connect to database';
        } 
  
        //go to view all filtered clients
        return view('clients.index', compact('clients','services'));
    }


    /*
    * This function takes category from user and returns all services from this category
    *
    *
    */
    public function filterServicesByCategories($id)
    {
        try
        {
            //get the category by id
            $category = ServiceCategories::find($id);

            //get all services from this category
            $items = $category->services;

            //get page from input
            $page = Input::get('page', 1);

            //set number of items in a single page
            $perPage = 24;

            //create the clients paginator
            $services = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
                'path' => Paginator::resolveCurrentPath()
            ]);

            //get all categories for filtering
            $categories = ServiceCategories::orderBy('title')->get();
        }
        catch (QueryException $e)
        {
            $message = 'cannot connect to database';
        }
        

        //go to view filtered services
        return view('services.index', compact('services', 'categories'));
    }
}
