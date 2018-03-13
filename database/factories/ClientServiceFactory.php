<?php

use Faker\Generator as Faker;

$factory->define(App\ClientService::class, function (Faker $faker) {
    return [
        'client_id'=>$faker->numberBetween(1, App\Client::count()),
        'service_id'=>$faker->numberBetween(1, App\Service::count()),
        'payment_method'=>$faker->numberBetween(1, App\PaymentMethod::count()),
        'balance'=>$faker->numberBetween(-100,1000),
        'end_time'=>$faker->dateTimeInInterval($startDate = '-1 years', $interval = '+ 5 years', $timezone = null) ,
        'required_money'=>$faker->numberBetween(1,1000),
        'updated_at'=>$faker->dateTimeInInterval($startDate = '-45 days', $interval = '+ 40 days', $timezone = null) ,
        'created_at'=>$faker->dateTimeInInterval($startDate = '-1 years', $interval = '+ 1 years', $timezone = null) ,

    ];
});
