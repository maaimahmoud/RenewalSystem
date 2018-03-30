<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

use App\Service;
use App\PaymentMethod;
use App\ServiceCategories;
use App\User;

class ServiceController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            //get all services
            $services = Service::orderBy('title')->paginate(24);

            //get all categories to display for filtering
            $categories = ServiceCategories::orderBy('title')->get();
        }
        catch (QueryException $e)
        {
            $message = 'problem with connection with database';
            $myerrors = array($message);
            return redirect('/home')->withErrors($myerrors);
        }
        //show services in the page
        return view('services.index', compact('services', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try
        {
            //get all payment methods to display
            $payment_methods = PaymentMethod::orderBy('title')->get();

            //get all categories to display
            $categories = ServiceCategories::orderBy('title')->get();
        }
        catch (QueryException $e)
        {
            $message = 'problem with connection with database';
            $myerrors = array($message);
            return redirect('/home')->withErrors($myerrors);
        }
        //just go to the add service page
        return view('services.create', compact('payment_methods', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|unique:services',
            'description' => 'required',
            'cost' => 'required|numeric',
            'categories' => 'required',
            'payment_methods' => 'required'
        ]);

        //store service's info from inputs
        $service = new Service;
        $service->title = $request->input('title');
        $service->description = $request->input('description');
        $service->cost = $request->input('cost');

        try
        {
            //get category from its title
            $category = ServiceCategories::where('title','=', $request->get('categories'))->get()->first();
            $service->category_id = $category->id;
            //get payment method from its title
            $method = PaymentMethod::where('title', '=', $request->get('payment_methods'))->get()->first();
            $service->payment_method_id = $method->id;
        }
        catch (QueryException $e)
        {
            $message = 'problem with connection to database';
            $myerrors = array($message);
            return redirect('/home')->withErrors($myerrors);
        }

        try
        {
            //save service in database
            $service->save();
        }
        catch (QueryException $e)
        {
            $message = 'please check that the information are valid';

            $myerrors = array($message);

            return redirect('/services/create')->withErrors($myerrors);
        }

        //redirect to services page
        return redirect('/services/'.$service->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            //get service from database
            $service = Service::find($id);
            $service->category=ServiceCategories::find($service->category_id);
        }
        catch (QueryException $e)
        {
            $message = 'problem with connection to database';
            $myerrors = array($message);
            return redirect('/home')->withErrors($myerrors);
        }

        //show page of service's information
        return view('services.show')->with('service', $service);
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
            //get the required service to be edited
            $service = Service::find($id);
        }
        catch (QueryException $e)
        {
            $message = 'problem with connection to database';
            $myerrors = array($message);
            return redirect('/home')->withErrors($myerrors);
        }

        try
        {
            //get id of payment method of this service
            $pay_method = $service->payment_method_id;
            //get title of payment method to display
            $pay_method = PaymentMethod::where('id', $pay_method)->get()->first();

            //get id of category of this service
            $category_service = $service->category_id;
            //get title of category to display
            $category_service = ServiceCategories::where('id', $category_service)->get()->first();

            //get all payment methods to display
            $payment_methods = PaymentMethod::orderBy('title')->get();

            //get all categories to display
            $categories = ServiceCategories::orderBy('title')->get();
        }
        catch (QueryException $e)
        {
            $message = 'problem with connection to database';
            $myerrors = array($message);
            return redirect('/home')->withErrors($myerrors);
        }

        //go to the edit page
        return view('services.edit', compact('service', 'payment_methods', 'categories', 'pay_method', 'category_service'));
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

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'cost' => 'required|numeric',
            'categories' => 'required',
            'payment_methods' => 'required'
        ]);

        try
        {
            //get a specific service to edit
            $service = Service::find($id);
            //edit the services' information from inputs
            $service->title = $request->input('title');
            $service->description = $request->input('description');
            $service->cost = $request->input('cost');
            //get category from its title
            $category = ServiceCategories::where('title','=', $request->get('categories'))->get()->first();
            $service->category_id = $category->id;
            //get payment method from its title
            $method = PaymentMethod::where('title', '=', $request->get('payment_methods'))->get()->first();
            $service->payment_method_id = $method->id;
        }
        catch (QueryException $e)
        {
            $message = 'problem with connection to database';
            $myerrors = array($message);
            return redirect('/home')->withErrors($myerrors);
        }

        try
        {
            //save the service in database
            $service->save();
        }
        catch (QueryException $e)
        {
            $message = "please check that the information is valid and the title of the service is unique";
            $myerrors = array($message);
            return redirect('/services/'.$id.'/edit')->withErrors($myerrors);
        }

        //redirect to clients page
        return redirect('/services/'.$service->id)->with('success', 'information was edited successfully');
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
            //get service to be removed
            $service = Service::find($id);

            //remove service from database
            $service->delete();
        }
        catch (QueryException $e)
        {
            $message = 'problem with connection to database';
            $myerrors = array($message);
            return redirect('/services/'.$id)->withErrors($myerrors);
        }

        //redirect to services' page
        return redirect('/services')->with('success', 'Service was removed successfully');
    }

}
