<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Client;
use App\Service;
use App\ClientService;


class ClientController extends Controller
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
     * Display a listing of the clients.
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
            $my_errors = array($message);
            return redirect('/home')->withErrors($my_errors);
        }


        //go to view all clients
        return view('clients.index', compact('clients','services'));
    }

    /**
     * Show the form for creating a new client.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //just go to the add client page
        return view('clients.create');
    }

    /**
     * Store a newly created client in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:clients',
            'phone_number' => 'required|unique:clients|numeric'
        ]);


        //store clients info from inputs
        $client = new Client;
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
            $message = 'The phone number or Address is not valid';

            $my_errors = array($message);

            return view('clients.create')->withErrors($my_errors);
        }

        //redirect to clients page
        return redirect('/clients/'.$client->id);
    }

    /**
     * Display the specified client.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            //get client from database
            $client = Client::find($id);
        }
        catch(QueryException $e)
        {
            $message = 'cannot connect to database';
            $my_errors = array($message);
            return redirect('/home')->withErrors($my_errors);
        }

        //if there is no client with this id return that there is no client
        if ($client == [])
        {
            return redirect('/clients')->withErrors('No such client with that id');
        }

        $relation=ClientService::where('client_id','=',$id)->orderBy('end_time','desc')->join('services','services.id','=','client_services.service_id')->select('client_services.id','client_services.end_time','services.title')->get();

        $client->relation=$relation;

        //show page of client's information
        return view('clients.show',compact('client'));
    }

    /**
     * Show the form for editing the specified client.
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
            $my_errors = array($message);
            return redirect('/home')->withErrors($my_errors);
        }

        //if there is no client with this id return that there is no client
        if ($client == [])
        {
            return redirect('/clients')->withErrors('No such client with that id');
        }

        //go to the edit page
        return view('clients.edit')->with('client', $client);
    }

    /**
     * Update the specified client in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|numeric'
        ]);

        try
        {
            //get a specific client to edit
            $client = Client::find($id);
        }
        catch (QueryException $e)
        {
            $message = 'cannot connect to database';
            $my_errors = array($message);
            return redirect('/home')->withErrors($my_errors);
        }

        //if there is no client with this id return that there is no client
        if ($client == [])
        {
            return redirect('/clients')->withErrors('No such client with that id');
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
            $my_errors = array($message);
            return view('clients.edit')->with('client', $client)->withErrors($my_errors);
        }

        //redirect to clients page
        return redirect('/clients/'.$id)->with('success', 'information was edited successfully');
    }

    /**
     * Remove the specified client from storage.
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

            //if there is no client with this id return that there is no client
            if ($client == [])
            {
                return redirect('/clients')->withErrors('No such client with that id');
            }

            //remove client from database
            $client->delete();
        }
        catch (QueryException $e)
        {
            $message = 'problem with connection to database';
            $my_errors = array($message);
            return redirect('/clients/'.$id)->withErrors($my_errors);
        }

        //redirect to clients page
        return redirect('/clients')->with('success', 'Client was removed from system successfully');
    }
    
}
