<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;

class Appointment extends Model
{
    use SoftDeletes, CausesActivity, LogsActivity{
        LogsActivity::activity insteadof CausesActivity;
        CausesActivity::activity as log;
    }

    public  $with = ['customer'];
    protected $dates = ['deleted_at'];
    protected $fillable = ['title','customer_id','description','status','start_time','end_time'];

    public function customer(){
        return $this->belongsTo('App\Customer');
    }
    public function journals(){
        return $this->morphMany('App\Journal','related_obj');
    }
}
