<?php

namespace App;


use App\Traits\Addressable;
use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\CausesActivity;

class Account extends Model
{
    use SoftDeletes, Addressable, CausesActivity, LogsActivity{
        LogsActivity::activity insteadof CausesActivity;
        CausesActivity::activity as log;
    }

    public $obj_alias = 'Account';

    protected $dates = ['deleted_at'];

    public function employees(){
        return $this->hasMany('App\Customer');
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

    public function getActivityTitle(): string {
        if($this->id > 0){
            return $this->account_name."(#{$this->account_no})";
        }
    }
}
