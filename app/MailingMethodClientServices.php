<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailingMethodClientServices extends Model
{
    //
    public function clientservices(){
      return $this->belongsTo('App\ClientService');
    }
}
