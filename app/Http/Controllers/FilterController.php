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

            //if there is no client with this id return that there is no client
            if ($service == [])
            {
                return redirect('/clients')->withErrors('url is not correct');
            }

            //to send it later to the view
            $chosen_service=$service;

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
            $myerrors = array($message);
            return redirect('/home')->withErrors($myerrors);
        }

        //go to view all filtered clients
        return view('clients.index', compact('clients','services','chosen_service'));
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

            //if there is no client with this id return that there is no client
            if ($category == [])
            {
                return redirect('/services')->withErrors('url is not correct');
            }

            //to send the category to the view later
            $chosen_category=$category;

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
            $myerrors = array($message);
            return redirect('/home')->withErrors($myerrors);
        }


        //go to view filtered services
        return view('services.index', compact('services', 'categories','chosen_category'));
    }
}
