<?php

$factory->define(App\ServiceCategories::class, function () {
	$faker = Faker\Factory::create('ar_SA');
    return [
        'title'=> $faker->unique()->text($maxNbChars = 20),
        'created_at'=>$faker->dateTimeInInterval($startDate = '-6 years', $interval = '+ 6 years', $timezone = null) ,
        'updated_at'=>$faker->dateTimeInInterval($startDate = '-6 years', $interval = '+ 6 years', $timezone = null) 
    ];
});
