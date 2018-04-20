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
        factory(App\PaymentMethod::class,10)->create();
        factory(App\Client::class,300)->create();
        factory(App\Service::class,50)->create();
        factory(App\ClientService::class,500)->create();
        factory(App\MailingMethodClientServices::class,5000)->create();
    }
}
