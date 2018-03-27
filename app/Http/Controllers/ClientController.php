<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

use App\Client;
use App\Service;
use App\ClientService;


class ClientController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            //show all clients
            $clients = Client::orderBy('name')->paginate(24);

            //get all services
            $services = Service::orderBy('title')->get();
        }
        catch (QueryException $e)
        {
            $message = 'cannot connect to database';
        }


        //go to view all clients
        return view('clients.index', compact('clients','services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //just go to the add client page
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //store clients info from inputs
        $client = new Client;
        $client->name = $request->input('name');
        $client->email = $request->input('email');
        $client->phone_number = $request->input('phone_number');
        $client->address = $request->input('address');


         //save client in database
        $client->save();

        //redirect to clients page
        return redirect('/clients/'.$client->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get client data from database
        $client = Client::find($id);
        $arr=array();

        $relation=ClientService::where('client_id','=',$id)->get();

        $client->relation=$relation;

        //show page of client's information
        return view('clients.show',compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try
        {
            //get the client with that id
            $client = Client::find($id);
        }
        catch (QueryException $e)
        {
            $message = 'cannot connect to database';
        }

        //get the current information of this client to display them
        $name = $client->name;
        $email = $client->email;
        $phone_number = $client->phone_number;
        $address = $client->address;

        //go to the edit page
        return view('clients.edit', compact('name', 'email', 'phone_number', 'address', 'client'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            //get a specific client to edit
            $client = Client::find($id);
        }
        catch (QueryException $e)
        {
            $message = 'cannot connect to database';
        }

        //edit the clients information from inputs
        $client->name = $request->input('name');
        $client->email = $request->input('email');
        $client->phone_number = $request->input('phone_number');
        $client->address = $request->input('address');

        try
        {
            //save client in database
            $client->save();
        }
        catch (QueryException $e)
        {
            $message = "please check that the information is valid";
        }


        //redirect to clients page
        return redirect('/clients/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            //get client to be removed
            $client = Client::find($id);

            //remove client from database
            $client->delete();
        }
        catch (QueryException $e)
        {
            $message = 'problem with connection to database';
        }

        //redirect to clients page
        return redirect('/clients');
    }

    public function getClientsFromService($id)
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
        $clients = new LengthAwarePaginator(
            $items->forPage($page, $perPage), $items->count(), $perPage, $page
        );
        //get all services
        $services = Service::orderBy('title')->get();
        //go to view all filtered clients
        return view('clients.index', compact('clients','services'));
    }

}
