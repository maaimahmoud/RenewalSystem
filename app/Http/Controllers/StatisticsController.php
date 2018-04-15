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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {   
        $service_count=(Service::all()->count());
        $client_count=(Client::all()->count());
        $service_categories_count=(ServiceCategories::all()->count());
        $payment_method_count=(PaymentMethod::all()->count());

        $service_categories_time = StatisticsController::getServiceChartWithTime();


        $client_time =StatisticsController::getCientChartWithTime();


        $service_time = StatisticsController::getServiceChartWithTime();


        $clients_by_categories = StatisticsController::getClientCategoryChart();
        $clients_by_payment_methods = StatisticsController::getClientPaymentMethodChart();
        $clients_by_services = StatisticsController::getClientServiceChart();
        $service_by_categories = StatisticsController::getServiceCategoryChart();
      
        return view('statistics', compact('service_time','client_time','service_categories_time','service_count','client_count','service_categories_count','payment_method_count','clients_by_categories','service_by_categories','clients_by_services','clients_by_payment_methods'));
}
public function getClientServiceQuery()
{
      $clients_by_services_query = DB::table('client_services')
                    ->select(DB::raw('count(*) as num , services.title as title'))
                    ->join('services','service_id','=','services.id')
                    ->groupBy('service_id','services.title')
                    ->get();
        return($clients_by_services_query);
}
public function getClientServiceChart()
{
    $clients_by_services_query=StatisticsController::getClientServiceQuery();
      $clients_by_services = Charts::create('pie', 'highcharts')
                    ->title('clients_by_services')
                    ->elementLabel('clients_by_services')
                    ->labels($clients_by_services_query->pluck('title'))
                    ->values($clients_by_services_query->pluck('num'))
                     ->width(1200)
                     ->height(700)
                    ->responsive(false);

    return ($clients_by_services);

}


public function getClientCategoryQuery()
{
      
    $clients_by_categories_query = DB::table('services')
                    ->select(DB::raw('count(client_services.id) as num , service_categories.title as title'))
                    ->join('client_services','services.id','=','client_services.service_id')
                    ->join('service_categories','services.category_id','=','service_categories.id')
                    ->groupBy('service_categories.id','service_categories.title')
                    ->get();
    return($clients_by_categories_query);
}
public function getClientCategoryChart()
{
    $clients_by_categories_query =StatisticsController::getClientCategoryQuery();
    $clients_by_categories = Charts::create('pie', 'highcharts')
                    ->title('clients_by_categories')
                    ->elementLabel('clients_by_categories')
                    ->labels($clients_by_categories_query->pluck('title'))
                    ->values($clients_by_categories_query->pluck('num'))
                     ->width(1200)
                     ->height(700)
                    ->responsive(false);
    return ($clients_by_categories);

}
public  function getClientPaymentMethodQuery()
{
        $clients_by_payment_methods_query = DB::table('client_services')
                    ->select(DB::raw('count(*) as num , payment_methods.title as title'))
                    ->join('payment_methods','payment_method','=','payment_methods.id')
                    ->groupBy('payment_method','payment_methods.title')
                    ->get();
        return($clients_by_payment_methods_query);
}
public  function getClientPaymentMethodChart()
{
    $clients_by_payment_methods_query=StatisticsController::getClientPaymentMethodQuery();
      $clients_by_payment_methods = Charts::create('pie', 'highcharts')
                    ->title('clients_by_payment_methods')
                    ->elementLabel('clients_by_payment_methods')
                    ->labels($clients_by_payment_methods_query->pluck('title'))
                    ->values($clients_by_payment_methods_query->pluck('num'))
                     ->width(1200)
                     ->height(700)
                    ->responsive(false);

    return ($clients_by_payment_methods);
}

public  function getServiceCategoryQuery()
{
      $service_by_categories_query = DB::table('services')
                    ->select(DB::raw('count(*) as num , service_categories.title '))
                    ->join('service_categories','category_id','=','service_categories.id')
                    ->groupBy('category_id','service_categories.title')
                    ->get();

        return($service_by_categories_query);

}
public  function getServiceCategoryChart()
{
    $service_by_categories_query =StatisticsController::getServiceCategoryQuery();
    $service_by_categories = Charts::create('pie', 'highcharts')
                    ->title('service_by_categories')
                    ->elementLabel('service_by_categories')
                    ->labels($service_by_categories_query->pluck('title'))
                    ->values($service_by_categories_query->pluck('num'))
                     ->width(1200)
                     ->height(700)
                    ->responsive(false);

    return ($service_by_categories);

}

public function getServiceCategoryChartWithTime()
{
    $service_categories_time = Charts::database(ServiceCategories::all(), 'bar', 'highcharts')
                    ->elementLabel("Categories")
                    ->title('Service_Categories')
                    ->dimensions(1000, 500)
                    ->responsive(false)
                    ->width(1300)
                    ->groupByYear(5);
    return($service_categories_time);

}
public function getServiceChartWithTime()
{
    $service_time = Charts::database(Service::all(), 'bar', 'highcharts')
                    ->elementLabel("Services")
                    ->title('Services')
                    ->dimensions(1000, 500)
                    ->responsive(false)
                     ->width(1300)
                    ->groupByYear(5);
    return($service_time);
}

public function getCientChartWithTime()
{
     $client_time = Charts::database(Client::all(), 'bar', 'highcharts')
                    ->elementLabel("Clients")
                    ->title('Clients')
                    ->dimensions(1000, 500)
                    ->responsive(false)
                    ->width(1300)
                    ->groupByYear(5);
return($client_time);
}
}