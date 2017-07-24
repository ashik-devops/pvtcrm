<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

class Task extends Model
{
    use SoftDeletes, CausesActivity, LogsActivity{
        LogsActivity::activity insteadof CausesActivity;
        CausesActivity::activity as log;
    }

    public $obj_alias = 'Task';

    protected $dates = ['deleted_at'];

    public function customer(){
        return $this->belongsTo('App\Customer');
    }

    public function journals(){
        return $this->morphMany('App\Journal','related_obj');
    }
    public function getLink(): string {

        return '#';
    }
    public function getActivityTitle(): string {
        if($this->id > 0){
            return $this->title;
        }
    }
}
