<?php

use Faker\Generator as Faker;

$factory->define(App\MailingMethodClinetServices::class, function (Faker $faker) {
    return [
        'days_to_mail'=>$faker->numberBetween(1, 45),
        'required_months_to_pay'=>$faker->numberBetween(1, 24),
        'last_paid_date'=>$faker->dateTimeInInterval($startDate = '-1 years', $interval = '+ 1 years', $timezone = null) ,
        'client_services_id'=>$faker->numberBetween(1, App\ClientService::count()),
    ];
});
