<?php

use Faker\Generator as Faker;

$factory->define(App\Service::class, function (Faker $faker) {
    return [
        'title'=>$faker->unique()->text($maxNbChars = 20),
        'category_id'=>$faker->numberBetween(1, App\ServiceCategories::count()),
        'cost'=>$faker->numberBetween(100,100),
        'payment_method_id'=>$faker->numberBetween(1, App\PaymentMethod::count()),
        'description'=>$faker->text,
    ];
});