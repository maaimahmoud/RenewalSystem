<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function payment_method()
    {
        return $this->belongsTo('App\PaymentMethod');
    }
}
