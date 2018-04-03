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
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($client_id)
  {
    try
    {
      //Prepare all data needed to add service
      $client=Client::find($client_id);

      //if there is no client with this id return that there is no client
      if ($client == [])
      {
          return redirect('/clients')->withErrors('No such client with that id');
      }

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
  public function store(Request $request,$client_id)
  {
        $this->validate($request, [
            'service' => 'required',
            'payment_method' => 'required',
            'end_date' => 'required'
        ]);

        $id=$client_id;

        try
        {
            //first find Client info as it goes back to clients.show page to display his info
            $client=Client::find($id);
        }
        catch(QueryException $e)
        {
            $message = 'cannot connect to database';
            $myerrors = array($message);
            return redirect('/home')->withErrors($myerrors);
        }

        //if there is no client with this id return that there is no client
        if ($client == [])
        {
            return redirect('/clients')->withErrors('No such client with that id');
        }

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

            $myerrors = array($message);

            return redirect()->route('clients.show',['id' => $client->id])->withErrors($myerrors);
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
              $payment=PaymentMethod::find($data->payment_method);
              $new->required_months_to_pay=$payment->months;
              $new->save();
            }
        }

        //redirect to client's info page
        return redirect()->route('clients.show',['id' => $client->id])->with('success', 'Service has been added successfully');

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($client_id,$service_id)
  {
    try
    {
        //Get relation info by its id
        $relation=ClientService::find($service_id);

        // Get Client's info for which service is provided to
        $client=Client::find($client_id);

        //if there is no client with this id return that there is no client
        if ($client == [] || $relation == [])
        {
            return redirect('/clients')->withErrors('No such client or service with that url');
        }

        // Get Service info to show when user click on it
        $service=Service::find($relation->service_id);
    }
    catch (QueryException $e)
    {
        $message = 'problem with connecting to database';
        $myerrors = array($message);
        return redirect('/home')->withErrors($myerrors);
    }

    // Get payment method info for this Relation
    $payment_method=PaymentMethod::find($relation->payment_method);
    $mailing_methods=MailingMethodClientServices::where('client_services_id','=', $relation->id)->orderBy('days_to_mail')->get();
    return view('clients.services.show',compact('relation','client','service','payment_method','mailing_methods'));

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($client_id,$service_id)
  {
      try
      {

        //Prepare all data needed to edit service
        $client=Client::find($client_id);
        //Get Relation between this service and client
        $relation=ClientService::find($service_id);

        //if there is no client with this id return that there is no client
        if ($client == [] || $relation == [])
        {
            return redirect('/clients')->withErrors('No such client or service with that url');
        }

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
        $current_mailing_methods=MailingMethodClientServices::where('client_services_id','=', $service_id)->orderBy('days_to_mail')->get();
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
  public function update(Request $request,$client_id,$service_id)
  {

        try
        {
            //get a specific client to edit
            $relation = ClientService::find($service_id);
        }
        catch (QueryException $e)
        {
            $message = 'cannot connect to database';
            $myerrors = array($message);
            return redirect('/home')->withErrors($myerrors);
        }

        //if there is no client with this id return that there is no client
        if ($relation == [])
        {
            return redirect('/clients')->withErrors('url is not correct');
        }

        //edit the clients information from inputs
        $relation->payment_method = PaymentMethod::where('months','=',$request->input('payment_method'))->get()->first()->id;
        //End time of service as every service has a life time
        $relation->end_time=$request->input('end_date');
        $reminders=$request->input('numberofreminders');
        $current_mailing_methods=MailingMethodClientServices::where('client_services_id','=', $service_id)->delete();

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
      return redirect('/clients/'.$client_id.'/service/'.$relation->id)->with('success', 'Service has been edited successfully');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($client_id,$service_id)
  {
      try
      {
        $clientservice=ClientService::find($service_id);
        //if there is no client with this id return that there is no client
        if ($clientservice == [])
        {
            return redirect('/clients')->withErrors('url is not correct');
        }
        $clientservice->end_time=date('Y-m-d H:i:s');
        echo $clientservice;
        $clientservice->save();
      }
      catch (QueryException $e)
      {
        echo $e;
          $message = 'problem with connection to database';
          $myerrors = array($message);
          return redirect('/home')->withErrors($myerrors);
      }

      //redirect to clients page
      return redirect('/clients/'.$client_id)->with('success', 'Service has been stopped successfully');;
  }

  /*
* This function to support the client to pay for his service
*
*/
public function payForService($client_id, $relation_id)
{

    //get money from request
    $money = Input::get('money');

    try
    {
        //get client to service relation from id
        $relation = ClientService::find($relation_id);

        //if there is no client with this id return that there is no client
        if ($relation == [])
        {
            return redirect('/clients')->withErrors('url is not correct');
        }
    }
    catch (QueryException $e)
    {
        $message = 'cannot connect to database';
        $myerrors = array($message);
        return redirect('/home')->withErrors($myerrors);
    }

    //get the total money of the client by adding paid money to the balance of him/her
    $total_money = $money + $relation->balance;

    //check for total money if larger than required money of not
    if ($total_money >= $relation->required_money)
    {
        //if greater than the required money then set required money to zero and the rest of money in his/her balance
        $relation->balance = $total_money - $relation->required_money;
        $relation->required_money = 0;
    }
    else
    {
        //if not then the balance will be zero and the total money will be subtracted from required money
        $relation->balance = 0;
        $relation->required_money = $relation->required_money - $total_money;
    }

    //save the relation between client and service
    try
    {
        $relation->save();
    }
    catch (QueryException $e)
    {
        $message = 'cannot connect to database';
        $myerrors = array($message);
        return redirect('/home')->withErrors($myerrors);
    }

    return redirect('/clients/'.$clientid.'/service/'.$relation->id)->with('success', 'successfully paid');
}


}
