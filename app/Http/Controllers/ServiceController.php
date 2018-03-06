<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all services
        $services = Service::all();
        //show services in the page
        return view('Servicespages.index')->with('services', $services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //just go to the add client page
        return view('Servicespages.Add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //store service's info from inputs
        $service = new Service;
        $service->title = $request->input('title');
        $service->description = $request->input('description');
        $service->cost = $request->input('cost');
        $service->category_id = $request->input('category_id');
        $service->payment_method_id = $request->input('payment_method_id');
        
        //save service in database
        $service->save();

        //redirect to services page
        return redirect('/services');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get service from database
        $service = Service::find($id);

        //show page of service's information
        return view('Servicespages.View')->with('service', $service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //get a specific service to edit
        $service = Service::find($id);

        //edit the services' information from inputs
        $service->title = $request->input('title');
        $service->description = $request->input('description');
        $service->cost = $request->input('cost');
        $service->category_id = $request->input('category_id');
        $service->payment_method_id = $request->input('payment_method_id');

        //save the service in database
        $service->save();

        //redirect to clients page
        return redirect('/services');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get service to be removed
        $service = Service::find($id);

        //remove service from database
        $service->delete();

        //redirect to services' page
        return redirect('/services');
     }
    
}
