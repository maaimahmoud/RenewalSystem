<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use Illuminate\Support\Str;
use DB;
use Mail;

define("late_time",60);

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
        //finished services should be deleted from table mails
        $client_services_id_to_mail = getClientsToMail ();
        if ($client_services_id_to_mail)
        {
            $Mails_Infos = getMailsInfo($client_services_id_to_mail);
            sendMails ($Mails_Infos);
        }

    }

    protected function getClientsToMail ()
    {
        return DB::select('SELECT client_services_id
                            FROM mailing_method_clinet_services
                            WHERE required_days_to_pay > DATEDIFF(CURTIME(),last_paid_date) 
                            AND required_days_to_pay - DATEDIFF(CURTIME(),last_paid_date) = days_to_mail;');

    }

    protected function getMailsInfo ($ids)
    {
        return DB::table('client_services')
                ->whereIn('id', $ids)
                ->join('clients', 'client_services.client_id', '=', 'clients.id')
                ->join('services', 'client_services.service_id', '=', 'services.id')
                ->select('clients.name as client_name', 'clients.email','clients.phone_number','client_services.balance','client_services.requierd_money','services.title as service_name')
                ->get();

    }

    protected function sendMails ($mails_info)
    {
        $send_time = now()->addMinutes($late_time);

        foreach ($mails_info as $mail_info){
            Mail::send('mail', $mail_info, function($message) {
                $message->to($mail_info['email'], $mail_info['client_name'])
                        ->subject($mail_info['service_name']);
                $message->from('systemrenewal@gmail.com','Renewal System');//->later($when);
                });
            $send_time=$send_time+$late_time;
        }
      
    }
}
