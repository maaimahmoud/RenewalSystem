<?php

use Illuminate\Database\Seeder;

class PaymentMethod extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create('ar_SA');
         $num=20;
        for ($i = 0; $i < $num; $i++) {
         DB::table('payment_methods')->insert([ 
        'title' => $faker->unique()->realText(10),
        'months' => $faker->unique()->numberBetween(1,25),
        'created_at'=>$faker->dateTimeInInterval($startDate = '-6 years', $interval = '+ 6 years', $timezone = null) ,
        'updated_at'=>$faker->dateTimeInInterval($startDate = '-6 years', $interval = '+ 6 years', $timezone = null) 
    ]);
    }
}

}