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
    public function getColors($number)
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
        return ($colors);
  }
   
    public function index()
    {   
        //get total number of services from database
        $service_count=(Service::all()->count());
        //get total number of clients from database
        $client_count=(Client::all()->count());
        //get total number of categories from database
        $service_categories_count=(ServiceCategories::all()->count());
        //get total number of payment method from database
        $payment_method_count=(PaymentMethod::all()->count());
        //get chart of used categories across years for the last 5 years
        $service_categories_time = StatisticsController::getServiceCategoryChartWithTime();
        //get chart of comming clients across years for the last 5 years
        $client_time =StatisticsController::getCientChartWithTime();    
        //get chart of used services across years for the last 5 years
        $service_time = StatisticsController::getServiceChartWithTime();
        //get percentage of used categories with clients
        $clients_by_categories = StatisticsController::getClientCategoryChart();
        //get percentage of used methods with clients
        $clients_by_payment_methods = StatisticsController::getClientPaymentMethodChart();
        //get percentage of used services with clients
        $clients_by_services = StatisticsController::getClientServiceChart();
        //get percentage of used services with categories
        $service_by_categories = StatisticsController::getServiceCategoryChart();
      
        return view('statistics', compact('service_time','client_time','service_categories_time','service_count','client_count','service_categories_count','payment_method_count','clients_by_categories','service_by_categories','clients_by_services','clients_by_payment_methods'));
}
public function getClientServiceQuery()
{
    //get clients that used by each service
      $clients_by_services_query = DB::table('client_services')
                    ->select(DB::raw('count(*) as num , services.title as title'))
                    ->join('services','service_id','=','services.id')
                    ->groupBy('service_id','services.title')
                    ->get();
        //get number of used services by clients 
        $count=$clients_by_services_query->count();
        return compact('clients_by_services_query','count');
}
public function getClientServiceChart()
{
    //prepare data in order to put it chart 
    $clients_by_services_q=StatisticsController::getClientServiceQuery();
    //put data in chart shape
    $clients_by_services = Charts::create('pie', 'highcharts')
                    ->colors(StatisticsController::getColors($clients_by_services_q['count']))
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
     //get clients that used by each category
    $clients_by_categories_query = DB::table('services')
                    ->select(DB::raw('count(client_services.id) as num , service_categories.title as title'))
                    ->join('client_services','services.id','=','client_services.service_id')
                    ->join('service_categories','services.category_id','=','service_categories.id')
                    ->groupBy('service_categories.id','service_categories.title')
                    ->get();
        ////get number of used categories by clients 
       $count=$clients_by_categories_query->count();
    return compact('clients_by_categories_query','count');
}
public function getClientCategoryChart()
{
    //prepare data in order to put it in chart 
    $clients_by_categories_q =StatisticsController::getClientCategoryQuery();
    // put data in chart shape
    $clients_by_categories = Charts::create('pie', 'highcharts')
                    ->title('clients_by_categories')
                    ->colors(StatisticsController::getColors($clients_by_categories_q['count']))
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
     //get clients that used by each method
        $clients_by_payment_methods_query = DB::table('client_services')
                    ->select(DB::raw('count(*) as num , payment_methods.title as title'))
                    ->join('payment_methods','payment_method','=','payment_methods.id')
                    ->groupBy('payment_method','payment_methods.title')
                    ->get();
          // get number of used payment methods by clients 
        $count=$clients_by_payment_methods_query->count();
        return compact('clients_by_payment_methods_query','count');
}
public  function getClientPaymentMethodChart()
{
    //prepare data in order to put it in chart 
    $clients_by_payment_methods_q=StatisticsController::getClientPaymentMethodQuery();
       // put data in chart shape
      $clients_by_payment_methods = Charts::create('pie', 'highcharts')
                    ->title('clients_by_payment_methods')
                    ->colors(StatisticsController::getColors($clients_by_payment_methods_q['count']))
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
    //get service that in each category
      $service_by_categories_query = DB::table('services')
                    ->select(DB::raw('count(*) as num , service_categories.title '))
                    ->join('service_categories','category_id','=','service_categories.id')
                    ->groupBy('category_id','service_categories.title')
                    ->get();
        // get number of used service in categories 
        $count=$service_by_categories_query->count();
        return compact('service_by_categories_query','count');
}
public  function getServiceCategoryChart()
{
    //prepare data in order to put it in chart 
    $service_by_categories_q=StatisticsController::getServiceCategoryQuery();
       // put data in chart shape
    $service_by_categories = Charts::create('pie', 'highcharts')
                    ->title('service_by_categories')
                    ->colors(StatisticsController::getColors($service_by_categories_q['count']))
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
    // prepare data of service_categories number within the last 5 years 
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
     // prepare data of service_categories number within the last 5 years 
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
     // prepare data of service_categories number within the last 5 years 
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