<?php

namespace App;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\DetectsChanges;

class Customer extends Model
{
    use SoftDeletes, DetectsChanges, CausesActivity, LogsActivity{
        LogsActivity::activity insteadof CausesActivity;
        CausesActivity::activity as log;
    }

    public $obj_alias = 'Customer';

    public  $with = ['account'];
    protected $dates = ['deleted_at'];
    protected static $logAttributes = ['first_name', 'last_name', 'title', 'email', 'phone_no', 'user', 'account', 'priority'];
    protected static $logOnlyDirty = true;
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function account(){
        return $this->belongsTo('App\Account');
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
    public function journals(){
        return $this->hasMany('App\Journal');
    }
    public function getLink(): string {
        if($this->id > 0){
            return route('view-customer', $this->id);
        }

        return '#';
    }
    public function getActivityTitle(): string {
        if($this->id > 0){
            return implode(', ', array_filter([$this->last_name, $this->first_name]))."({$this->account->account_no})";
        }
    }

}
