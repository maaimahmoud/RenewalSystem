<?php

$factory->define(App\Client::class, function () {
	$faker = Faker\Factory::create('ar_SA');
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone_number' => $faker->unique()->numberBetween(1000000,9999999), // secret
        'address' => $faker->address,
        'created_at'=>$faker->dateTimeInInterval($startDate = '-6 years', $interval = '+ 6 years', $timezone = null) ,
        'updated_at'=>$faker->dateTimeInInterval($startDate = '-6 years', $interval = '+ 6 years', $timezone = null) 
    ];
});
