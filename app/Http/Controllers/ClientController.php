<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Client;
use App\Service;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //show all clients
        $clients = Client::all();

        //go to view all clients
        return view('clients.index')->with('clients', $clients);
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
        return redirect('/clients');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get client from database
        $client = Client::find($id);

        $services = Service::find($client->service_id);

        //show page of client's information
        return view('clients.show',compact('client','services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get the client with that id
        $client = Client::find($id);

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
        //get a specific client to edit
        $client = Client::find($id);

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
        //get client to be removed
        $client = Client::find($id);

        //remove client from database
        $client->delete();

        //redirect to clients page
        return redirect('/clients');
    }
}
