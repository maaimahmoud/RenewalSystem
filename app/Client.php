<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    public function services(){
      return $this->belongsToMany('App\Service','client_services');
    }


    //
    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("name", "LIKE","%$keyword%")
                    ->orWhere("email", "LIKE", "%$keyword%")
                    ->orWhere("address", "LIKE", "%$keyword%")
                    ->orWhere("phone_number", "LIKE",  "%$keyword%");
            });
        }
        return $query;
    }
}
