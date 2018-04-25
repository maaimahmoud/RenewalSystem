<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\PaymentMethod;
use Carbon\Carbon;
use App\ClientService;
use DB;
use App\Service;

class TriggerMoney extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'TriggerMoney:AddRequiredMoney';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds required money to be paid for clients';

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
     * This function adds required money for clients at the specified time to pay
     * @return mixed
     */
    public function handle()
    {
        //get all client services that should be paid today
        $client_services = DB::select('SELECT * from client_services where now() <= end_time and day(now()) = day(created_at)');

        //get today time
        $now = Carbon::now();

        foreach ($client_services as $client_service)
        {
            //get payment method of this client_service
            $payment_method = PaymentMethod::find($client_service->payment_method);

            //get date of start of the service
            $start_date = Carbon::parse($client_service->created_at);

            //get difference between now and start of the service
            $diff = $now->diffInMonths($start_date);

            if ($diff % $payment_method->months == 0)
            {
                //get service
                $service = Service::find($client_service->service_id);

                //get payment method of this service
                $service_payment_method = PaymentMethod::find($service->payment_method_id);

                //calculate required money to pay
                $money_to_pay = floatval($service->cost) / $service_payment_method->months * $payment_method->months;
                $money_to_pay += $client_service->required_money;

                //get the object of the relation to change its info
                $relation = ClientService::find($client_service->id);

                //check for total money if larger than required money or not
                if ($relation->balance >= $money_to_pay)
                {
                    //if greater than the required money then set required money to zero and the rest of money in his/her balance
                    $relation->balance -= $money_to_pay;
                    $relation->required_money = 0;
                }
                else
                {
                    //if not then the balance will be zero and the total money will be subtracted from required money
                    $relation->required_money = $money_to_pay - $relation->balance;
                    $relation->balance = 0;
                }
                $relation->save();
            }
        }
    }
}
