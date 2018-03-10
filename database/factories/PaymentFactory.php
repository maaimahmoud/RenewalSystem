<?php

use Faker\Generator as Faker;

$factory->define(App\PaymentMethod::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->text($maxNbChars = 20),
        'days' => $faker->unique()->numberBetween(1,45),
    ];
});
