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
        factory(App\Client::class,10)->create();
        factory(App\Service::class,10)->create();
        factory(App\ClientService::class,30)->create();
        factory(App\MailingMethodClientServices::class,100)->create();
    }
}
