<?php

use Illuminate\Database\Seeder;
use App\ServiceCategories;
use App\PaymentMethod;
class Service extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create('ar_SA');
         $num=50;
        for ($i = 0; $i < $num; $i++) {
         DB::table('services')->insert([ 
          'title'=>$faker->unique()->realtext(20),
        'category_id'=>$faker->numberBetween(1, App\ServiceCategories::count()),
        'cost'=>$faker->numberBetween(100,1000),
        'payment_method_id'=>$faker->numberBetween(1, App\PaymentMethod::count()),
        'description'=>$faker->realtext(120),
        'created_at'=>$faker->dateTimeInInterval($startDate = '-6 years', $interval = '+ 6 years', $timezone = null) ,
        'updated_at'=>$faker->dateTimeInInterval($startDate = '-6 years', $interval = '+ 6 years', $timezone = null) ]);
    }
}
}
