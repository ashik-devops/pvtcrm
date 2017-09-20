<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
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

    public function journal(): MorphOne{
        return $this->morphOne('App\Journal', 'journalable');
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
