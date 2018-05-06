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
   * Show the form for creating a new client_service.
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
      $payment_methods = PaymentMethod::orderBy('months')->get();
      //if client wants to add a service to a particular category
      $service_categories=ServiceCategories::All();
      //intialize variables to distinguish between editing and adding service

    }
    catch (QueryException $e)
    {
        $message = 'problem with connecting to database';
        $my_errors = array($message);
        return redirect('/home')->withErrors($my_errors);
    }

    //Go to the input page with provided lists
    return view('clients.services.create',compact('client','services','relation','payment_methods','service_categories','current_service','current_payment_method','current_end_time','current_mailing_methods'));
  }

  /**
   * Store a newly created client_service in storage.
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

        try
        {
            //first find Client info as it goes back to clients.show page to display his info
            $client=Client::find($client_id);
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

        //and also client services to display
        $services = $client->services;
        //create a new relation to store data
        $data = new ClientService;
        //fill relation data with inputs from user
        $data->client_id = $client_id;
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

            $my_errors = array($message);

            return redirect()->route('clients.show',['id' => $client->id])->withErrors($my_errors);
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
   * Display the specified client_service.
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
        $my_errors = array($message);
        return redirect('/home')->withErrors($my_errors);
    }

    // Get payment method info for this Relation
    $payment_method=PaymentMethod::find($relation->payment_method);
    $mailing_methods=MailingMethodClientServices::where('client_services_id','=', $relation->id)->orderBy('days_to_mail')->get();
    return view('clients.services.show',compact('relation','client','service','payment_method','mailing_methods'));

  }

  /**
   * Show the form for editing the specified client_service.
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
        $service_categories=ServiceCategories::All();
        //Get All payment methods from database if the client wants to change his current payment method
        $payment_methods = PaymentMethod::orderBy('months')->get();
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
        $my_errors = array($message);
        return redirect('/home')->withErrors($my_errors);
      }
      //Go to the input page with provided lists
      return view('clients.services.create',compact('client','services','relation','paymentmethods','servicecategories','current_service','current_payment_method','current_end_time','current_mailing_methods'));
}

  /**
   * Update the specified client_service in storage.
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
            $my_errors = array($message);
            return redirect('/home')->withErrors($my_errors);
        }

        //if there is no client with this id return that there is no client
        if ($relation == [])
        {
            return redirect('/clients')->withErrors('url is not correct');
        }

        //edit the clients information from inputs
        $relation->payment_method=$request->input('payment_method');
        //End time of service as every service has a life time
        $relation->end_time=$request->input('end_date');
        $reminders=$request->input('numberofreminders');
        $current_mailing_methods=MailingMethodClientServices::where('client_services_id','=', $service_id)->get()->first();
        $last_paid=$current_mailing_methods->last_paid_date;
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
              $new->last_paid_date=$last_paid;
              $payment=PaymentMethod::find($relation->payment_method);
              $new->required_months_to_pay=$payment->months;
              $new->save();
            }
        }



      //redirect to clients page
      return redirect('/clients/'.$client_id.'/service/'.$relation->id)->with('success', 'Service has been edited successfully');
  }

  /**
   * Remove the specified client_service from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($client_id,$service_id)
  {
      try
      {
        $client_service=ClientService::find($service_id);
        //if there is no client with this id return that there is no client
        if ($client_service == [])
        {
            return redirect('/clients')->withErrors('url is not correct');
        }
        $client_service->delete();
      }
      catch (QueryException $e)
      {
          $message = 'problem with connection to database';
          $my_errors = array($message);
          return redirect('/home')->withErrors($my_errors);
      }

      //redirect to clients page
      return redirect('/clients/'.$client_id)->with('success', 'Service has been deleted successfully');;
  }

  /*
  * This funciton sets the end date of the service to now
  * to stop the client from using this service
  */
  public function stop($client_id,$service_id)
  {
      try
      {
        $client_service=ClientService::find($service_id);
        //if there is no client with this id return that there is no client
        if ($client_service == [])
        {
            return redirect('/clients')->withErrors('url is not correct');
        }
        $client_service->end_time=date('Y-m-d H:i:s');
        $client_service->save();
      }
      catch (QueryException $e)
      {
          $message = 'problem with connection to database';
          $my_errors = array($message);
          return redirect('/home')->withErrors($my_errors);
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
        $my_errors = array($message);
        return redirect('/home')->withErrors($my_errors);
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
        $my_errors = array($message);
        return redirect('/home')->withErrors($my_errors);
    }

    return redirect('/clients/'.$client_id.'/service/'.$relation->id)->with('success', 'Successfully paid');
}

public function editReminder(Request $request,$days_to_mail, $client_service_id)
{

   $this->validate($request, [
            'day_to_mail' => 'required|numeric|max:50|min:1']);
    //get all reminders to this services through this client
    $mailing_methods=MailingMethodClientServices::where('client_services_id','=', $client_service_id)->orderBy('days_to_mail')->get();
    // get their number 
    $mailing_methods_number=$mailing_methods->count();
    // get relation in order to be redirected 
    $relation=ClientService::find($client_service_id);
    // loop on already made reminders in order to be unique
    for ($i=0;$i<$mailing_methods_number;$i++)
    {
      if ($mailing_methods[$i]->days_to_mail==$request->input('day_to_mail'))
      {
          $message=" this reminder is already made";
          $myerrors = array($message);

          return redirect('/clients/'.$relation->client_id.'/service/'.$client_service_id)->withErrors($myerrors);
      }
    } 
// get reduired edited one in order to change it 
    $mailing_method=MailingMethodClientServices::where('client_services_id','=', $client_service_id)->where('days_to_mail','=',$days_to_mail)->get()->first();
        try{
          $new=new MailingMethodClientServices;
              $new->client_services_id=$client_service_id;
              $new->days_to_mail=$request->input('day_to_mail');
              $new->last_paid_date=$mailing_method->last_paid_date;
              $new->required_months_to_pay=$mailing_method->required_months_to_pay;
              $new->save();
        }
       catch (QueryException $e)
       {
        $message = 'cannot connect to database';
        $myerrors = array($message);
        return redirect('/home')->withErrors($myerrors);
        }

    $mailing_method=MailingMethodClientServices::where('client_services_id','=', $client_service_id)->where('days_to_mail','=',$days_to_mail)->delete();
    return redirect('/clients/'.$relation->client_id.'/service/'.$client_service_id)->with('success', 'Successfully Edited');
}



public function deleteReminder($days_to_mail,$client_service_id)
{
   // get relation in order to be redirected 
    $relation=ClientService::find($client_service_id);
    $mailing_methods=MailingMethodClientServices::where('client_services_id','=', $client_service_id)->orderBy('days_to_mail')->get();
    // get their number 
    $mailing_methods_number=$mailing_methods->count();
     // get relation in order to be redirected 
    $relation=ClientService::find($client_service_id);
    // check that there exist another reminders 
    if ($mailing_methods_number<= 1)
    {
      $message=" there will be no reminders so this can't be deleted";
       $myerrors = array($message);
      return redirect('/clients/'.$relation->client_id.'/service/'.$client_service_id)->withErrors($myerrors);
    }
    // get specific reminder in order to delete it 
   $mailing_method=MailingMethodClientServices::where('client_services_id','=', $client_service_id)->where('days_to_mail','=',$days_to_mail)->delete();
   return redirect('/clients/'.$relation->client_id.'/service/'.$client_service_id)->with('sucess','successfully deleted');
}


}
