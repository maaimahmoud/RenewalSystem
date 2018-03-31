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
use DB;

class StatisticsController extends Controller
{
    public function index()
    {   
        $clients_by_categories_query = DB::table('services')
                    ->select(DB::raw('count(client_services.id) as num , service_categories.title as title'))
                    ->join('client_services','services.id','=','client_services.service_id')
                    ->join('service_categories','services.category_id','=','service_categories.id')
                    ->groupBy('service_categories.id')
                    ->get();
        $clients_by_categories = Charts::create('pie', 'highcharts')
                    ->title('My nice chart')
                    ->elementLabel('My nice label')
                    ->labels($clients_by_categories_query->pluck('title'))
                    ->values($clients_by_categories_query->pluck('num'))
                    ->responsive(true);


        $clients_by_payment_methods_query = DB::table('client_services')
                    ->select(DB::raw('count(*) as num , payment_methods.title as title'))
                    ->join('payment_methods','payment_method','=','payment_methods.id')
                    ->groupBy('payment_method')
                    ->get();
        $clients_by_payment_methods = Charts::create('pie', 'highcharts')
                    ->title('My nice chart')
                    ->elementLabel('My nice label')
                    ->labels($clients_by_payment_methods_query->pluck('title'))
                    ->values($clients_by_payment_methods_query->pluck('num'))
                    ->responsive(true);

        $clients_by_services_query = DB::table('client_services')
                    ->select(DB::raw('count(*) as num , services.title as title'))
                    ->join('services','service_id','=','services.id')
                    ->groupBy('service_id')
                    ->get();
        $clients_by_services = Charts::create('pie', 'highcharts')
                    ->title('My nice chart')
                    ->elementLabel('My nice label')
                    ->labels($clients_by_services_query->pluck('title'))
                    ->values($clients_by_services_query->pluck('num'))
                    ->responsive(true);
        
        $service_by_categories_query = DB::table('services')
                    ->select(DB::raw('count(*) as num , service_categories.title '))
                    ->join('service_categories','category_id','=','service_categories.id')
                    ->groupBy('category_id')
                    ->get();
        $service_by_categories = Charts::create('pie', 'highcharts')
                    ->title('My nice chart')
                    ->elementLabel('My nice label')
                    ->labels($service_by_categories_query->pluck('title'))
                    ->values($service_by_categories_query->pluck('num'))
                    ->responsive(true);
           
        $categories_by_time = Charts::database(ServiceCategories::all(), 'bar', 'highcharts')
                    ->elementLabel("Total")
                    ->dimensions(1000, 500)
                    ->responsive(true)
                    ->groupByYear(5);
        $client_by_time = Charts::database(Client::all(), 'bar', 'highcharts')
                    ->elementLabel("Total")
                    ->dimensions(1000, 500)
                    ->responsive(true)
                    ->groupByYear(5);
        $service_by_time = Charts::database(Service::all(), 'bar', 'highcharts')
                    ->elementLabel("Total")
                    ->dimensions(1000, 500)
                    ->responsive(true)
                    ->groupByYear(5);
        $client_service_by_time = Charts::database(ClientService::all(), 'bar', 'highcharts')
                    ->elementLabel("Total")
                    ->dimensions(1000, 500)
                    ->responsive(true)
                    ->groupByYear(5);
                    
        $chart = $clients_by_payment_methods;
        return view('statistics', compact('chart'));


    }
}
