<?php

use Illuminate\Database\Seeder;

class  Client extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $faker = Faker\Factory::create('ar_SA');
         $num=200;
        for ($i = 0; $i < $num; $i++) {
         DB::table('clients')->insert([ 
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone_number' => $faker->unique()->numberBetween(1000000,9999999), 
        'address' => $faker->address,
        'created_at'=>$faker->dateTimeInInterval($startDate = '-6 years', $interval = '+ 6 years', $timezone = null) ,
        'updated_at'=>$faker->dateTimeInInterval($startDate = '-6 years', $interval = '+ 6 years', $timezone = null) 
    ]);
}
    }
}
