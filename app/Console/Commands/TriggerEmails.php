<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use Illuminate\Support\Str;
use DB;

class TriggerEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'TriggerEmails:checkmails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check the database and time of payming';// and list all mails/servecis to be send';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // DB::table('users')->insert(
        //     ['email' => Str::random(20), 'name' => 'hamada','password'=>'hady']
        // );
        // TriggerEmails:checkmails
        $user=new User;
        $user->name='hamada';
        $user->email=$random = Str::random(20);
        $user->password='hady';
        $user->save();
        
        $users_to_mail = DB::table('users')
                ->whereDate('created_at', '2016-12-31')
                ->get();
        
    }
}
