<?php



$factory->define(App\Service::class, function() {
	$faker = Faker\Factory::create('ar_SA');
    return [
        'title'=>$faker->unique()->text($maxNbChars = 20),
        'category_id'=>$faker->numberBetween(1, App\ServiceCategories::count()),
        'cost'=>$faker->numberBetween(100,1000),
        'payment_method_id'=>$faker->numberBetween(1, App\PaymentMethod::count()),
        'description'=>$faker->text,
        'created_at'=>$faker->dateTimeInInterval($startDate = '-6 years', $interval = '+ 6 years', $timezone = null) ,
        'updated_at'=>$faker->dateTimeInInterval($startDate = '-6 years', $interval = '+ 6 years', $timezone = null) 
    ];
});
