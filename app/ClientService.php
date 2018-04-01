<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientService extends Model
{
    //
    public function mailingmethods()
    {
        return $this->hasMany('App\MailingMethodClientServices');
    }
}
