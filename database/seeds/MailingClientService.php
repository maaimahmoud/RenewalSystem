<?php

use Illuminate\Database\Seeder;
use App\ClientService;


class MailingClientService extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $faker = Faker\Factory::create('en_US');
        $num=500;
        for ($i = 0; $i < $num; $i++) {
         DB::table('mailing_method_client_services')->insert([ 
       'days_to_mail'=>$faker->numberBetween(1, 45),
        'required_months_to_pay'=>$faker->numberBetween(1, 24),
        'last_paid_date'=>$faker->dateTimeInInterval($startDate = '-1 years', $interval = '+ 1 years', $timezone = null) ,
        'client_services_id'=>$faker->numberBetween(1, App\ClientService::count()),
        'created_at'=>$faker->dateTimeInInterval($startDate = '-6 years', $interval = '+ 6 years', $timezone = null) ,
        'updated_at'=>$faker->dateTimeInInterval($startDate = '-6 years', $interval = '+ 6 years', $timezone = null) 
    ]);
    }
}
}
