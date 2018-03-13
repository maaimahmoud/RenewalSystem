<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\User::class,10)->create();
        factory(App\ServiceCategories::class,10)->create();
        factory(App\PaymentMethod::class,20)->create();
        factory(App\Client::class,1000)->create();
        factory(App\Service::class,1000)->create();
        factory(App\ClientService::class,3000)->create();
        factory(App\MailingMethodClinetServices::class,10000)->create();
    }
}
