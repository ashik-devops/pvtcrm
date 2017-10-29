<?php

namespace App;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\CausesActivity;

class UserGroup extends Model
{
    use SoftDeletes, CausesActivity, LogsActivity{
        LogsActivity::activity insteadof CausesActivity;
        CausesActivity::activity as log;
    }
    protected static $logOnlyDirty = true;

    public function members(): BelongsToMany{
        return $this->belongsToMany('App\User', 'group_users', 'group_id', 'user_id');
    }

    public function getLink(): string {
        if($this->id > 0){
            return '#';
        }

        return '#';
    }

    public function getActivityTitle(): string {
        if($this->id > 0){
            return ' User Group '.$this->name;

        }
        return "";
    }



}
