<?php

use Faker\Generator as Faker;

$factory->define(App\PaymentMethod::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->text($maxNbChars = 20),
        'months' => $faker->unique()->numberBetween(1,24),
        'created_at'=>$faker->dateTimeInInterval($startDate = '-6 years', $interval = '+ 6 years', $timezone = null) ,
        'updated_at'=>$faker->dateTimeInInterval($startDate = '-6 years', $interval = '+ 6 years', $timezone = null) 
    ];
});
