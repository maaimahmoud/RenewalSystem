<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MailController extends Controller {
   
    //
        public function basic_email(){
        $data = array('name'=>"Virat Gandhi");
    
        Mail::send(['text'=>'mail'], $data, function($message) {
            $message->to('abdokaseb@gmail.com')->subject
                ('mohamed is stupit monkey w b i kbera');
            $message->from('abdokaseb@gmail.com');
        });
        echo "Basic Email Sent. Check your inbox.";
    }

    public function html_email(){
        $data = array('name'=>"Virat Gandhi");
        Mail::send('mail', $data, function($message) {
            $message->to('abdokaseb@gmail.com', 'Tutorials Point')->subject
                ('Laravel HTML Testing Mail');
            $message->from('systemrenewal@gmail.com','Virat Gandhi');
        })->later(now()->addMinutes(3), new MailController);
        echo "HTML Email Sent. Check your inbox.";
    }
    
}
