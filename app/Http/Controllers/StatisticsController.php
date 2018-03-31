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
        $user_time = Charts::database(User::all(), 'bar', 'highcharts')
                    ->elementLabel("Total")
                    ->dimensions(1000, 500)
                    ->responsive(true)
                    ->groupByYear(5);
        $service_categories_time = Charts::database(ServiceCategories::all(), 'bar', 'highcharts')
                    ->elementLabel("Total")
                    ->dimensions(1000, 500)
                    ->responsive(true)
                    ->groupByYear(5);
        $client_time = Charts::database(Client::all(), 'bar', 'highcharts')
                    ->elementLabel("Total")
                    ->dimensions(1000, 500)
                    ->responsive(true)
                    ->groupByYear(5);
        $service_time = Charts::database(Service::all(), 'bar', 'highcharts')
                    ->elementLabel("Total")
                    ->dimensions(1000, 500)
                    ->responsive(true)
                    ->groupByYear(5);
        $service_time = Charts::database(Service::all(), 'bar', 'highcharts')
                    ->elementLabel("Total")
                    ->dimensions(1000, 500)
                    ->responsive(true)
                    ->groupByYear(5);
        
        $chart = $service_time;
        return view('statistics', compact('chart'));


    }
}
