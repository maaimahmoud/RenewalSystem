<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function payment_method()
    {
        return $this->belongsTo('App\PaymentMethod');
    }

    public function clients(){
      return $this->belongsToMany('App\Client', 'client_services');
    }

    public function service_categories()
    {
        return $this->belongsTo('App\ServiceCategories', 'category_id');
    }


    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("title", "LIKE","%$keyword%")
                    ->orWhere("cost", "LIKE", "%$keyword%")
                    ->orWhere("description", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }

}
