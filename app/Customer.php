<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Customer extends Model
{
    use SoftDeletes, LogsActivity;
    public  $with = ['company'];
    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['first_name', 'last_name', 'title', 'email', 'phone_no', 'user', 'company', 'priority'];

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
    public function appointments(){
        return $this->hasMany('App\Appointment');
    }
}
