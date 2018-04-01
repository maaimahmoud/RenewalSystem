<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\User;
use Illuminate\Support\Str;
use DB;
use Mail;


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
        //get clients ids from the database
        $client_services_id_to_mail = $this->getClientsToMail ();

        if ($client_services_id_to_mail)
        {
            $Mails_Infos = $this->getMailsInfo($client_services_id_to_mail);
            $this->sendMails ($Mails_Infos);
        }

    }

    protected function getClientsToMail ()
    {
        $result = DB::select('SELECT client_services_id as id
                            FROM mailing_method_clinet_services
                            WHERE  DATE_ADD( last_paid_date , INTERVAL required_months_to_pay MONTH) > curdate()
                            AND DATEDIFF( DATE_ADD( last_paid_date , INTERVAL required_months_to_pay MONTH), curdate() ) = days_to_mail;');
        $ID_Arr = [];
        foreach($result as $row){
            $ID_Arr[] = ((array) $row)['id'];
        }
        return $ID_Arr;        
    }

    protected function getMailsInfo ($ids)
    {
        return DB::table('client_services')
                ->whereIn('client_services.id', $ids)
                ->join('clients', 'client_services.client_id', '=', 'clients.id')
                ->join('services', 'client_services.service_id', '=', 'services.id')
                ->select('clients.name as client_name', 'clients.email as email','clients.phone_number','client_services.balance','client_services.required_money','services.title as service_name','services.email_template')
                ->get();

    }

    protected function sendMails ($mails_info)
    {
        foreach ($mails_info as $data){
            $mail_info=((array) $data);
            //sending mail to every client
            Mail::send('mail', $mail_info, function($message) use ($mail_info) {
                $message->to($mail_info['email'], $mail_info['client_name'])
                        ->subject($mail_info['service_name']);
                $message->from('systemrenewal@gmail.com','Renewal System');
            });
        }
      
    }
}
