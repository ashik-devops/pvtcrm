<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function company(){
        return $this->belongsTo('App\Customer_company');
    }

    public function addresses(){
        return $this->belongsToMany('App\Address', 'customer_addresses', 'customer_id', 'address_id')->withPivot(['type']);
    }

}
