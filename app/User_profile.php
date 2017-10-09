<?php

namespace App;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\CausesActivity;

class User_profile extends Model
{
use SoftDeletes, CausesActivity, LogsActivity{
    LogsActivity::activity insteadof CausesActivity;
    CausesActivity::activity as log;
}
    public $obj_alias = 'User Profile';

    public function user(): BelongsTo{
        return $this->belongsTo('App\User');
    }

    public function timezone(): BelongsTo{
        return $this->belongsTo('App\Timezone');
    }

    public function getLink(): string {
        if($this->id > 0){
            return route('profile-view', $this->user->id);
        }

        return '#';
    }

    public function address(): BelongsTo{
        return $this->belongsTo('App\Address');
    }

    public function getActivityTitle(): string {
        if($this->id > 0){
            return $this->user->name;
        }
        return "";
    }


}
