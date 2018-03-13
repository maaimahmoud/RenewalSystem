<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceCategories extends Model
{
    public function services()
    {
        return $this->hasMany('App\Service', 'category_id');
    }
}
