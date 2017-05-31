<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;
    public function user(){
        return $this->belongsToMany('App\Customer', 'customer_addresses', 'address_id', 'customer_id');
    }
}
