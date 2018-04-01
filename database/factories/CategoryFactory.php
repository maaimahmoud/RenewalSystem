<?php

use Faker\Generator as Faker;

$factory->define(App\ServiceCategories::class, function (Faker $faker) {
    return [
        'title'=> $faker->unique()->text($maxNbChars = 20),
    ];
});
