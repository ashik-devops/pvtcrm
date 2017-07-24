<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

class Account extends Model
{
    use SoftDeletes, CausesActivity, LogsActivity{
        LogsActivity::activity insteadof CausesActivity;
        CausesActivity::activity as log;
    }

    public $obj_alias = 'Account';

    protected $dates = ['deleted_at'];

    public function employees(){
        return $this->hasMany('App\Customer');
    }

    public function addresses(){
        return $this->belongsToMany('App\Address', 'account_addresses', 'account_id', 'address_id')->withPivot(['type']);
    }

    public function tasks(){
        return $this->hasManyThrough('App\Task', 'App\Customer');
    }
    public function appointments(){
        return $this->hasManyThrough('App\Appointment', 'App\Customer');
    }
    public function journals(){
        return $this->hasManyThrough('App\Journal', 'App\Customer');
    }

    public function getLink(): string {
        if($this->id > 0){
            return route('view-account', $this->id);
        }

        return '#';
    }
}
