<?php


$factory->define(App\ClientService::class, function () {
    $faker = Faker\Factory::create('ar_SA');
    return [
        'client_id'=>$faker->numberBetween(1, App\Client::count()),
        'service_id'=>$faker->numberBetween(1, App\Service::count()),
        'payment_method'=>$faker->numberBetween(1, App\PaymentMethod::count()),
        'balance'=>$faker->numberBetween(0,0),
        'end_time'=>$faker->dateTimeInInterval($startDate = '-1 years', $interval = '+ 5 years', $timezone = null) ,
        'required_money'=>$faker->numberBetween(1,1000),
        'created_at'=>$faker->dateTimeInInterval($startDate = '-6 years', $interval = '+ 6 years', $timezone = null) ,
        'updated_at'=>$faker->dateTimeInInterval($startDate = '-6 years', $interval = '+ 6 years', $timezone = null) 

    ];
});
