<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer_company extends Model
{
    public function employees(){
        return $this->hasMany('App\Customer');
    }

    public function address(){
        return $this->belongsToMany('App\Address', 'cusotmers_company_addresses', 'customer_comapny_id', 'address_id')->withPivot(['type']);
    }

}
