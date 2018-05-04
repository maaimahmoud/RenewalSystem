<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\ClientService;
use App\PaymentMethod;



use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class Event
{
  public $title;
  public $start;
  public $url;
}

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('welcome');
    }
   

    /*
    * This function gets events to be displayed in the calender
    * in the home page
    */
    public function getEvents()
    {
      $array=array();
      //Get list of all relation between client and service to put reminders in calendar
      //by joining tables client and clientservice to get information needed for every service company provides to a client
      $list=ClientService::join('clients','clients.id','=','client_services.client_id')->select('name','end_time','client_services.id as url','clients.id as id','client_services.created_at','payment_method')->get();
      //This loop for each service client has
      foreach ($list as $value) {
          //Get payment method for this service to this client
          $payment=PaymentMethod::find($value->payment_method);
          //Get Months of this payment method ( 1,2 or 3 months etc.)
          $per_months=$payment->months;
          // A variable next reminder starts from the date this service is created and ends at service end
          $nextReminder=$value->created_at;
          // Url for client service profile
          $url='/clients/'.$value->id.'/service/'.$value->url;
          //This loop is executed from the start of service and step by payment method months until it reaches the ends
          //provides all due dates of this client to his service
          while ($nextReminder < $value->end_time) {
            //Add Months to the time
            $time = strtotime($nextReminder);
            //Add number of months of payment method
            $str='+'.$per_months.' month';
            //Get the new date in datetime format
            $nextReminder = date("Y-m-d H:i:s", strtotime($str, $time));
            //Checks date is not after the end time of service
            if ($nextReminder < $value->end_time){
                //Then, create new event contains variable to show in calendar
                $object = new Event();
                //takes client name as the title of the event
                $object->title = $value->name;
                //adding calculated date to the new event
                $object->start=$nextReminder;
                //attach event url to connect the event with service client page
                $object->url=$url;
                //add the event to array of events
                array_push($array,$object);
              }

          }
      }
      //return array to calendar to display
      return json_encode($array);
    }

}
