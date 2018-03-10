<?php

use Faker\Generator as Faker;

$factory->define(App\MailingMethodClinetServices::class, function (Faker $faker) {
    return [
        'mailing_methods_id'=>$faker->numberBetween(1, App\MailingMethod::count()),
        'client_services_id'=>$faker->numberBetween(1, App\ClientService::count()),
    ];
});
