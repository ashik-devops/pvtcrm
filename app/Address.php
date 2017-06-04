<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;
    public function customer(){
        return $this->belongsToMany('App\Customer', 'customer_addresses', 'address_id', 'customer_id');
    }
    public function company(){
        return $this->belongsToMany('App\Customer', '`customers_company_addresses`', 'address_id', 'customer_company_id');
    }
}
