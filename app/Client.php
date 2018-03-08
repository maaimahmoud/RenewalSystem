<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    public function services(){
      return $this->belongsToMany('App\Service','client_services');
    }
}
