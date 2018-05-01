<?php

use Illuminate\Database\Seeder;

class ServiceCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('ar_SA');
        $num=100;
        for ($i = 0; $i < $num; $i++) {
            DB::table('service_categories')->insert([ 
                'title' => $faker->unique()->company(20),
                'created_at'=>$faker->dateTimeInInterval($startDate = '-6 years', $interval = '+ 6 years', $timezone = null) ,
        		'updated_at'=>$faker->dateTimeInInterval($startDate = '-6 years', $interval = '+ 6 years', $timezone = null)]);
        }

    }
}
