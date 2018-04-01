<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;

use App\ClientService;
use App\PaymentMethod;
use App\Service;

class TriggerMoney extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'TriggerMoney:addMoney';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'adding required money to be paid periodically for the clients';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //get all client services with payment methods
        $client_services = ClientService::all();

        //get todays datetime
        $now = date('Y-m-d H:i:s');

        foreach ($client_services as $client_service)
        {
            // if this day is the day of payment and the service hasnot reached its end time
            if (date("d",strtotime($client_service->created_at)) == date("d",$now) && strtotime($client_service->end_time) > $now)
            {
                //get difference between now and the start of the service in months
                $date_interval = $now->diff(strtotime($client_service->created_at));
                $totalMonths = 12 * $dateInterval->y + $dateInterval->m;

                //get payment method related with this client service relation
                $payment_method = PaymentMethod::find($client_service->payment_method);

                //check if number of payment months chosen by user has passed already
                if($totalMonths % $payment_method->months == 0)
                {
                    //get service of this relation
                    $service = Service::find($client_service->service_id);

                    //add money to be paid to the relation assuming that service cost is per month
                    $client_service->required_money += $service->cost;

                    //save again to database
                    $client_service->save();
                }
            }
        }
        
    }
}
