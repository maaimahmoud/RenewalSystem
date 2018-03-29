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

class ClientServiceController extends Controller
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
      //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($clients)
  {
    try
    {
      //Prepare all data needed to add service
      $client=Client::find($clients);
      //Get All Services from database to add one of them to client
      $services = Service::All();
      //Get All payment methods from database to add one of them to client
      $paymentmethods = PaymentMethod::All();
      //if client wants to add a service to a particular category
      $servicecategories=ServiceCategories::All();
      //intialize variables to distinguish between editing and adding service

    }
    catch (QueryException $e)
    {
        $message = 'problem with connecting to database';
        $myerrors = array($message);
        return redirect('/home')->withErrors($myerrors);
    }
    //Go to the input page with provided lists

    return view('clients.services.create',compact('client','services','relation','paymentmethods','servicecategories','current_service','current_payment_method','current_end_time','current_mailing_methods'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request,$clients)
  {
        $id=$clients;
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

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($clients,$service)
  {
        $relation=ClientService::find($service);
        $client=Client::find($clients);
        $service=Service::find($relation->service_id);
        $payment_method=PaymentMethod::find($relation->payment_method);
        return view('clients.services.show',compact('relation','client','service','payment_method'));

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($clients,$service)
  {
      try
      {

        //Prepare all data needed to edit service
        $client=Client::find($clients);
        //Get Relation between this service and client
        $relation=ClientService::find($service);
        //Get the service information
        $services=Service::All();
        //Get the category for service
        $servicecategories=ServiceCategories::All();
        //Get All payment methods from database if the client wants to change his current payment method
        $paymentmethods = PaymentMethod::All();
        ///////////////////////////////
        $current_service =Service::find($relation->service_id);
        //Get current paymentmethod
        $current_payment_method = PaymentMethod::find($relation->payment_method);
        //Get current end_date
        $current_end_time=$relation->end_time;
        //Get current mailing method
        //$current_mailing_methods=$relation->mailingmethods;
        $current_mailing_methods=MailingMethodClientServices::where('client_services_id','=', $service)->get();
      }
      catch (QueryException $e)
      {
        $message = 'cannot connect to database';
        $myerrors = array($message);
        return redirect('/home')->withErrors($myerrors);
      }
      //Go to the input page with provided lists
      return view('clients.services.create',compact('client','services','relation','paymentmethods','servicecategories','current_service','current_payment_method','current_end_time','current_mailing_methods'));
}

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request,$clients,$service)
  {

        try
        {
            //get a specific client to edit
            $relation = ClientService::find($service);
        }
        catch (QueryException $e)
        {
            $message = 'cannot connect to database';
            $myerrors = array($message);
            return redirect('/home')->withErrors($myerrors);
        }

        //edit the clients information from inputs
        $relation->payment_method = $request->input('payment_method');
        //End time of service as every service has a life time
        $relation->end_time=$request->input('end_date');
        $reminders=$request->input('numberofreminders');
        $current_mailing_methods=MailingMethodClientServices::where('client_services_id','=', $service)->delete();

        try
        {
            //save client in database
            $relation->save();
        }
        catch (QueryException $e)
        {
            $relation = "please check that the information is valid";
        }

        for ($i=1; $i <= $reminders ; $i++) {
          # code...
          if ($request->input('mailreminder'.$i) != "") {
                # code...
              $new=new MailingMethodClientServices;
              $new->client_services_id=$relation->id;
              $input='mailreminder'.$i;
              $new->days_to_mail=$request->input($input);
              $new->last_paid_date=date('Y-m-d H:i:s');
              $new->save();
            }
        }



      //redirect to clients page
      return redirect('/clients/'.$clients);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($clients,$service)
  {
      try 
      {
        $clientservice=ClientService::find($service);
        $clientservice->end_time=date('Y-m-d H:i:s');
        $clientservice->save();
      }
      catch (QueryException $e)
      {
          $message = 'problem with connection to database';
          $myerrors = array($message);
          return redirect('/home')->withErrors($myerrors);
      }

      //redirect to clients page
      return redirect('/clients/'.$clients);
  }

}
