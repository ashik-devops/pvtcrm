<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function company(){
        return $this->belongsTo('App\Customer_company', 'customer_company_id');
    }

    public function addresses(){
        return $this->belongsToMany('App\Address', 'customer_addresses', 'customer_id', 'address_id')->withPivot(['type']);
    }
    public function tasks(){
        return $this->hasMany('App\Task');
    }
}
