<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ServiceCategories;
use App\PaymentMethod;
use App\Client;
use App\Service;
use App\ClientService;
use Charts;
class StatisticsController extends Controller
{
    public function index()
    {   
        $service_count=(Service::all()->count());
        $client_count=(Client::all()->count());
        $service_categories_count=(ServiceCategories::all()->count());
        $payment_method_count=(PaymentMethod::all()->count());

        $service_categories_time = Charts::database(ServiceCategories::all(), 'bar', 'highcharts')
                    ->elementLabel("Categories")
                    ->title('Service_Categories')
                    ->dimensions(1000, 500)
                    ->responsive(true)
                    ->groupByYear(5);
        $client_time = Charts::database(Client::all(), 'bar', 'highcharts')
                    ->elementLabel("Clients")
                    ->title('Clients')
                    ->dimensions(1000, 500)
                    ->responsive(true)
                    ->groupByYear(5);
        $service_time = Charts::database(Service::all(), 'bar', 'highcharts')
                    ->elementLabel("Services")
                    ->title('Services')
                    ->dimensions(1000, 500)
                    ->responsive(true)
                    ->groupByYear(5);
       
        
        return view('statistics', compact('service_time','client_time','service_categories_time','service_count','client_count','service_categories_count','payment_method_count'));


    }
}
