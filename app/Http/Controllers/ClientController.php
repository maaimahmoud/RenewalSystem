<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

use App\Client;
use App\Service;
use App\PaymentMethod;
use App\ServiceCategories;
use App\ClientService;
use App\MailingMethodClientServices;



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
        //get client from database
        $client = Client::find($id);

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

    public function requestaddservice($id)
    {
      try
      {
        //Prepare all data needed to add service
        $client=Client::find($id);
        //Get All Services from database to add one of them to client
        $services = Service::All();
        //Get All payment methods from database to add one of them to client
        $paymentmethods = PaymentMethod::All();
        //if client wants to add a service to a particular category
        $servicecategories=ServiceCategories::All();
        //intialize variables to distinguish between editing and adding service
        //Get current paymentmethod
        $current_payment_method=0;
        //Get current end_date
        $current_end_time=0;
        //Get current mailing method
        $current_mailing_methods=0;
      }
      catch (QueryException $e)
      {
          $message = 'problem with connecting to database';
      }
      //Go to the input page with provided lists
      return view('clients.addservice',compact('client','services','paymentmethods','servicecategories','$current_payment_method','$current_end_time','$current_mailing_methods'));
    }

    public function addservice(Request $request,$id)
    {

      //first find Client info as it goes back to clients.show page to display his info
      $client=Client::find($id);
      //and also client services to display
      $services = $client->services;
      //create a new relation to store data
      $data = new ClientService;
      //fill relation data with inputs from user
      $data->client_id = $id;
      //service that client wants to add
      $data->service_id = $request->input('service');
      //payment method as disscused with client
      $data->payment_method = $request->input('payment_method');
      //End time of service as every service has a life time
      $data->end_time=$request->input('end_date');

      //echo $data;

      $reminders=$request->input('numberofreminders');
      try
      {
          //save new relation in database
          $data->save();
      }
      catch (QueryException $e)
      {
          $message = "please check that the information is valid";
      }
      //echo $data;

      for ($i=1; $i <= $reminders ; $i++) {
        # code...
        if ($request->input('mailreminder'.$i) != "") {
              # code...
            $new=new MailingMethodClientServices;
            $new->client_services_id=$data->id;
            $input='mailreminder'.$i;
            $new->days_to_mail=$request->input($input);
            $new->last_paid_date=date('Y-m-d H:i:s');
            $new->save();
          }
      }

      //redirect to client's info page
      return redirect()->route('clients.show',['id' => $client->id]);
    }

    //
    public function deleteservice($id,$service_id){
      $client_id=$id;
      echo $id;
      echo $service_id;
      $relation=ClientService::where('client_id','=',$client_id)->where('service_id','=',$service_id)->get();
      echo $relation;
      try {
        $clientservice=ClientService::find($relation{id});
        $clientservice->delete();
      } catch (\Exception $e) {
        echo $e;
      }

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

    public function requesteditservice($client_id,$service_id){
      //Prepare all data needed to edit service
      $client=Client::find($client_id);
      //Get the service information
      $services=Service::find($service_id);
      //Get the category for service
      $servicecategories=ServiceCategories::find($services->category_id);
      //Get All payment methods from database if the client wants to change his current payment method
      $paymentmethods = PaymentMethod::All();
      ///////////////////////////////
      //Get relation
      $relation=ClientService::where('client_id','=',$client_id)->where('service_id','=',$service_id)->get();
      //Get current paymentmethod
      $current_payment_method=PaymentMethod::find($relation{payment_method});
      //Get current end_date
      $current_end_time=$relation->end_time;
      //Get current mailing method
      $current_mailing_methods=$relation->mailingmethods;
      //Go to the input page with provided lists
      return view('clients.addservice',compact('client','services','paymentmethods','servicecategories','$current_payment_method','$current_end_time','$current_mailing_methods'));

    }
}
