<?php

namespace App;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\CausesActivity;



class Journal extends Model
{
    use SoftDeletes, CausesActivity, LogsActivity{
        LogsActivity::activity insteadof CausesActivity;
        CausesActivity::activity as log;
    }


    public $obj_alias = 'Journal';

    public function journalable(): MorphTo {
        return $this->morphTo();
    }

    public function prev_journal() : HasOne{
        return $this->hasOne('App\Journal', 'prev_journal_id');
    }

    public function next_journal(): HasOne{
        return $this->hasOne('App\Journal', 'next_journal_id');
    }

    public function customer(){
        $this->belongsTo(Customer::class);
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
