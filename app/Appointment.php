<?php

namespace App;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\DetectsChanges;

class Appointment extends Model
{
    use SoftDeletes, CausesActivity, LogsActivity{
        LogsActivity::activity insteadof CausesActivity;
        CausesActivity::activity as log;
    }

    public $obj_alias = 'Appointment';

    public  $with = ['customer'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at', 'start_time', 'end_time'];
    protected $fillable = ['title','customer_id','description','status','start_time','end_time'];

    public function customer(){
        return $this->belongsTo('App\Customer');
    }
    public function journal():MorphOne{
        return $this->morphOne('App\Journal','journalable');
    }
    public function getLink(): string {
        return '#';
    }
    public function getActivityTitle(): string {
        if($this->id > 0){
            return $this->title;
        }
    }

    protected function asDateTime($value)
    {
        $defaultZone = 'America/New_York';
//        if(Auth::user()){
//            Auth::user()
//        }
        return parent::asDateTime($value)->timezone($defaultZone);
    }


}
