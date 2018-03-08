<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Client;
use Illuminate\Support\Str;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\TriggerEmails::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('TriggerEmails:checkmails')->everyMinute();
        
        $schedule->call(function () {
            $client=new Client;
            $client->name='hamada';
            $client->email=$random = Str::random(20);
            $client->phone_number= rand();
            $client->address='hady';
            $client->save();
            // DB::table('recent_users')->delete();
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
