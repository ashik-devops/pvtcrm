<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer_company extends Model
{
    public function employees(){
        return $this->hasMany('App\Customer');
    }

    public function address(){
        return $this->hasManyThrough('App\Address', 'App\Customer');
    }

}
