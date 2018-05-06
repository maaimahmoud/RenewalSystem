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
use Faker\Factory as Faker;

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

    public function getcolors($number)
    {
$colors =array ("FFA07A",
"20B2AA",
"87CEFA",
"778899",
"FFDEAD",
"4682B4",
"FFFFE0",
"00FF00",
"32CD32",
"7FFFD4",
"F0FFFF",
"F5F5DC",
"FFE4C4",
"FFEBCD",
"0000FF",
"8A2BE2",
"A52A2A",
"DEB887",
"5F9EA0",
"7FFF00",
"FFFAFA",
"00FF7F",
"FFD700",
"D2B48C",
"008080",
"D8BFD8",
"FF6347",
"40E0D0",
"778899",
"B0C4DE",
"D2691E",
"FF7F50",
"6495ED",
"FFF8DC",
"DC143C",
"00FFFF",
"00008B",
"008B8B",
"B8860B",
"A9A9A9",
"006400",
"FAF0E6",
"FF00FF",
"800000",
"66CDAA",
"0000CD",
"BA55D3",
"9370DB",
"3CB371",
"7B68EE",
"FFFF00",
"00FA9A",
"48D1CC",
"C71585",
"191970",
"F5FFFA",
"FFE4E1",
"000080",
"FDF5E6",
"808000",
"6B8E23",
"FFA500",
"FF4500",
"DA70D6",
"EEE8AA",
"98FB98",
"FFC0CB",
"AFEEEE",
"DB7093",
"FFEFD5",
"FFDAB9",
"CD853F",
"DDA0DD",
"B0E0E6",
"800080",
"663399",
"FF0000",
"BC8F8F",
"4169E1",
"8B4513",
"FA8072",
"F4A460",
"2E8B57",
"FFF5EE",
"A0522D",
"C0C0C0",
"FFE4B5",
"87CEEB",
"6A5ACD",
"708090",
"708090",
"EE82EE",
"F5DEB3",
"F5F5F5",

);
        for ($i=0;$i<$number;$i++)
        {
            $i=$i%93;
            $colors[$i]='#'.$colors[$i];
        }
       /* $faker=\Faker\Factory::create('en_US');
        for ($i=0;$i<$number;$i++)
        {
            $colors[$i]=$faker->unique()->numberBetween(1,16700000);
            $colors[$i]='#'.$colors[$i];
        }*/
/*
    for ($i=0;$i<$number;$i++)
    {
    $intnumber=rand(5,10);
    $red=$intnumber*rand(0,255);
    $green =$intnumber*rand(0,255);
    $blue = $intnumber*rand(0,255);

    $red = ($intnumber&0x0000ff) << 16;
    $green = ($intnumber&0x00ff00) <<8;
    $blue = ($intnumber&0xff0000) >> 10;

    $intnumber = $red|$green|$blue;
      // toString converts a number to a hexstring
      $HTMLcolor = (string)$intnumber;
      // adding # before each color
      $colors[$i]= '#' . $HTMLcolor;
  }
for ($i=0;$i<$colors->count();$i++)
{
    if ($colors[i])
}*/
    return ($colors);
}

    public function index()
    {   
         //return (StatisticsController::getcolors(25));
        $service_count=(Service::all()->count());
        $client_count=(Client::all()->count());
        $service_categories_count=(ServiceCategories::all()->count());
        $payment_method_count=(PaymentMethod::all()->count());

        $service_categories_time = StatisticsController::getServiceCategoryChartWithTime();

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
        $count=$clients_by_services_query->count();
        return compact('clients_by_services_query','count');
}
public function getClientServiceChart()
{
    $clients_by_services_q=StatisticsController::getClientServiceQuery();
      $clients_by_services = Charts::create('pie', 'highcharts')
                    ->colors(StatisticsController::getcolors($clients_by_services_q['count']))
                    ->title('clients_by_services')
                    ->elementLabel('clients_by_services')
                    ->labels($clients_by_services_q['clients_by_services_query']->pluck('title'))
                    ->values($clients_by_services_q['clients_by_services_query']->pluck('num'))
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
       $count=$clients_by_categories_query->count();
    return compact('clients_by_categories_query','count');
}
public function getClientCategoryChart()
{
    $clients_by_categories_q =StatisticsController::getClientCategoryQuery();
    $clients_by_categories = Charts::create('pie', 'highcharts')
                    ->title('clients_by_categories')
                    ->colors(StatisticsController::getcolors($clients_by_categories_q['count']))
                    ->elementLabel('clients_by_categories')
                    ->labels($clients_by_categories_q['clients_by_categories_query']->pluck('title'))
                    ->values($clients_by_categories_q['clients_by_categories_query']->pluck('num'))
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
        $count=$clients_by_payment_methods_query->count();
        return compact('clients_by_payment_methods_query','count');
}
public  function getClientPaymentMethodChart()
{
    $clients_by_payment_methods_q=StatisticsController::getClientPaymentMethodQuery();
      $clients_by_payment_methods = Charts::create('pie', 'highcharts')
                    ->title('clients_by_payment_methods')
                    ->colors(StatisticsController::getcolors($clients_by_payment_methods_q['count']))
                    ->elementLabel('clients_by_payment_methods')
                    ->labels($clients_by_payment_methods_q['clients_by_payment_methods_query']->pluck('title'))
                    ->values($clients_by_payment_methods_q['clients_by_payment_methods_query']->pluck('num'))
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
        $count=$service_by_categories_query->count();
        return compact('service_by_categories_query','count');

}
public  function getServiceCategoryChart()
{
    $service_by_categories_q=StatisticsController::getServiceCategoryQuery();
    $service_by_categories = Charts::create('pie', 'highcharts')
                    ->title('service_by_categories')
                    ->colors(StatisticsController::getcolors($service_by_categories_q['count']))
                    ->elementLabel('service_by_categories')
                    ->labels($service_by_categories_q['service_by_categories_query']->pluck('title'))
                    ->values($service_by_categories_q['service_by_categories_query']->pluck('num'))
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