<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

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

        //save client in database
        $client->save();

        //redirect to clients page
        return redirect('/');

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

        //show page of client's information
        return view('clients.show')->with('client', $client);
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

        //save client in database
        $client->save();

        //redirect to clients page
        return redirect('/');
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
