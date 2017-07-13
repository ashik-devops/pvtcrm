<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

class Customer_company extends Model
{
    use SoftDeletes, CausesActivity, LogsActivity{
        LogsActivity::activity insteadof CausesActivity;
        CausesActivity::activity as log;
    }

    protected $dates = ['deleted_at'];

    public function employees(){
        return $this->hasMany('App\Customer');
    }

    public function addresses(){
        return $this->belongsToMany('App\Address', 'customers_company_addresses', 'customer_company_id', 'address_id')->withPivot(['type']);
    }

    public function tasks(){
        return $this->hasManyThrough('App\Task', 'App\Customer');
    }
    public function appointments(){
        return $this->hasManyThrough('App\Appointment', 'App\Customer');
    }
}
